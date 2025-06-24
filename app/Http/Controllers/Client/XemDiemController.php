<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


use App\Models\SinhVien;
use App\Models\Lop;
use App\Models\Nam;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\NienKhoa;
use App\Models\DiemRenLuyen;
use App\Models\LopChuyenNganh;
use App\Models\ChuyenNganh;
use App\Models\HocKy;
use Illuminate\Support\Facades\DB;

class XemDiemController extends Controller
{
    public function ketquahoctap(){
        $id_sv = Auth::guard('student')->user()->id;

        $sinhVien = SinhVien::with('hoSo', 'lop', 'lopChuyenNganh')->findOrFail($id_sv);
        $lop = $sinhVien->lop;
        $nienkhoa = NienKhoa::findOrFail($lop->id_nien_khoa);
    
        $chuong_trinh_dao_tao = ChuongTrinhDaoTao::whereHas('chuyenNganh', function ($q) use ($lop) {
            $q->where('id_nganh_hoc', $lop->id_nganh_hoc);
        })->orderBy('id', 'asc')->first();
    
        if (!$chuong_trinh_dao_tao) {
            return redirect()->back()->with('error', 'Không có chương trình đào tạo nào.');
        }
    
        $ct_ctdt = ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao', 'hocKy'])
            ->where('id_chuong_trinh_dao_tao', $chuong_trinh_dao_tao->id)
            ->whereHas('hocKy', function ($q) use ($nienkhoa) {
                $q->where('id_nien_khoa', $nienkhoa->id);
            })
            ->get()
            ->groupBy('id_hoc_ky');
    
        $tenMons = $ct_ctdt->flatten()->pluck('monHoc.ten_mon')->filter()->unique();
    
        $diemHocPhan = DB::table('danh_sach_hoc_phan as dshp')
            ->join('lop_hoc_phan as lhp', 'lhp.id', '=', 'dshp.id_lop_hoc_phan')
            ->where('dshp.id_sinh_vien', $id_sv)
            ->whereIn('lhp.ten_hoc_phan', $tenMons)
            ->select(
                'lhp.ten_hoc_phan',
                'dshp.diem_chuyen_can',
                'dshp.diem_qua_trinh',
                'dshp.diem_thi',
                'dshp.diem_tong_ket'
            )
            ->get()
            ->keyBy('ten_hoc_phan');
    
        $gradesData = $ct_ctdt->mapWithKeys(function ($dsMon, $idHocKy) use ($diemHocPhan) {
            return [
                $idHocKy => $dsMon->map(function ($ct) use ($diemHocPhan) {
                    $tenMon = $ct->monHoc->ten_mon ?? '';
                    $diem = $diemHocPhan[$tenMon] ?? null;
    
                    return [
                        'ten_hoc_ky' => $ct->hocKy->ten_hoc_ky ?? '',
                        'ten_mon' => $tenMon,
                        'tin_chi' => $ct->so_tin_chi,
                        'chuyencan' => $diem->diem_chuyen_can ?? '-',
                        'quatrinh'  => $diem->diem_qua_trinh ?? '-',
                        'thi'       => $diem->diem_thi ?? '-',
                        'tongket'   => $diem->diem_tong_ket ?? '-',
                    ];
                })
            ];
        });

        $thongKeTungKy = [];

        foreach ($ct_ctdt as $idHocKy => $dsMon) {
            $tongTinChi = $dsMon->sum('so_tin_chi');
            $tongTiet = $dsMon->sum('so_tiet');
            $soMon = count($dsMon);

            
            $dsMonCoDiem = $dsMon->filter(function ($ct) {
                return is_numeric($ct->diem_tong_ket);
            });

            $tongDiem = $dsMonCoDiem->sum('diem_tong_ket');
            $soMonCoDiem = $dsMonCoDiem->count();

            $diemTB = $soMonCoDiem > 0 ? round($tongDiem / $soMonCoDiem, 2) : '-';

            $thongKeTungKy[$idHocKy] = [
                'so_mon' => $soMon,
                'tong_tin_chi' => $tongTinChi,
                'diem_trung_binh' => $diemTB
            ];
        }

       
        return view("client.xemdiem.ketquahoctap", compact('sinhVien','gradesData','thongKeTungKy'));
    }
    public function ketquarenluyen(Request $request)
    {
        $id_sv = Auth::guard('student')->user()->id;

        $sinhVien = SinhVien::with('hoSo', 'lop','lopChuyenNganh.chuyenNganh')->find($id_sv);

        $nienKhoa = NienKhoa::find($sinhVien->lop->id_nien_khoa);
        
        $dsNam = collect();

        if ($nienKhoa) {
            $start = $nienKhoa->nam_bat_dau;
            $end = $nienKhoa->nam_ket_thuc+1;

            // Tạo danh sách các năm từ niên khóa
            for ($year = $start; $year < $end; $year++) {
                $dsNam->push($year);
            }
        }

        $namDangChon = $request->input('id_nam') ?? now()->year;

        $nam = Nam::where('nam_bat_dau', $namDangChon)->first();

        $dsDiemRenLuyen = DiemRenLuyen::where('id_sinh_vien', $id_sv)
        ->when($nam?->id, fn($q) => $q->where('id_nam', $nam->id))
        ->orderBy('thoi_gian', 'asc')
        ->get();
        
        for ($i = 1; $i <= 12; $i++) {
            $diemThang = $dsDiemRenLuyen->where('thoi_gian', $i);
        }
       
        return view("client.xemdiem.ketquarenluyen", compact('sinhVien', 'dsDiemRenLuyen', 'dsNam', 'namDangChon'));
    }
    
}