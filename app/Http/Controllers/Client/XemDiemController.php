<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

use App\Models\SinhVien;
use App\Models\Lop;
use App\Models\Nam;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\NienKhoa;
use App\Models\DiemRenLuyen;
use App\Models\ChuyenNganh;
use App\Models\HocKy;
use App\Models\LopHocPhan;
use App\Models\DanhSachHocPhan;
use App\Enum\LoaiMonHoc;
use Illuminate\Support\Facades\DB;

class XemDiemController extends Controller
{
    public function ketquahoctap(){
        $id_sv = Auth::guard('student')->id();

        $sinhVien = SinhVien::with('danhSachSinhVien')->findOrFail($id_sv);
        $sinhVien->load('danhSachSinhVien.lop.nienKhoa');
        $ids_lop = $sinhVien->danhSachSinhVien->pluck('id_lop');

        $ids_nien_khoa = $sinhVien->danhSachSinhVien
            ->pluck('lop')   
            ->filter()           
            ->pluck('id_nien_khoa')
            ->unique()
            ->values();

        $lopHocPhanDaTao = LopHocPhan::whereIn('id_lop', $ids_lop)->get();

        $id_ctdtsDaTao = $lopHocPhanDaTao->pluck('id_chuong_trinh_dao_tao')->unique()->values();
        
        $lopHocPhanChuaTao = Lop::whereIn('id', $ids_lop)
            ->whereDoesntHave('lopHocPhans')
            ->first();

        $id_ctdtsChuaTao = $lopHocPhanChuaTao->chuyenNganh->chuongTrinhDaoTao->first();
        
        $id_ctdts = $id_ctdtsDaTao->merge($id_ctdtsChuaTao->id)->unique()->values();

        $chiTietCTDT = ChiTietChuongTrinhDaoTao::whereIn('id_chuong_trinh_dao_tao', $id_ctdts)->whereHas('hocKy', fn($q) => $q->where('id_nien_khoa', $ids_nien_khoa))
        ->get();
        
        $diemCacMon = DanhSachHocPhan::with('lopHocPhan')
            ->where('id_sinh_vien', $id_sv)
            ->whereHas('lopHocPhan', fn($q) => $q->where('trang_thai_nop_bang_diem', '>=', 3))
            ->get()
            ->keyBy(fn($item) => optional($item->lopHocPhan)->ten_hoc_phan);

        $monHocs = $chiTietCTDT->map(function ($ct) use ($diemCacMon) {
            $tenMon = $ct->monHoc->ten_mon;
            $diem = '-';

            foreach ($diemCacMon as $item) {
                if ($item->lopHocPhan && $item->lopHocPhan->ten_hoc_phan == $tenMon) {
                    $diem = $item->diem_tong_ket ?? '-';
                    break;
                }
            }

            return [
                'ten_mon' => $tenMon,
                'so_tin_chi' => $ct->so_tin_chi,
                'diem_tong_ket' => $diem,
            ];
        });

        $monTheoHocKy = $chiTietCTDT->groupBy('id_hoc_ky')->map(function ($monHocTrongKy) use ($diemCacMon) {
            return $monHocTrongKy->map(function ($ct) use ($diemCacMon) {
                $tenMon = $ct->monHoc->ten_mon;
                $diem = '-';
        
                foreach ($diemCacMon as $item) {
                    if ($item->lopHocPhan && $item->lopHocPhan->ten_hoc_phan == $tenMon) {
                        $diem = $item->diem_tong_ket ?? '-';
                        break;
                    }
                }
        
                return [
                    'ten_mon' => $tenMon,
                    'so_tin_chi' => $ct->so_tin_chi,
                    'diem_tong_ket' => $diem,
                ];
            });
        });
        
        return view("client.xemdiem.ketquahoctap", compact('sinhVien','monTheoHocKy'));
    }

    public function ketquarenluyen(Request $request)
    {
        $id_sv = Auth::guard('student')->user()->id;
        
        $sinhVien = SinhVien::with('hoSo', 'danhSachSinhVien.lop.chuyenNganh')->findOrFail($id_sv);
       
        $lopCuaSinhVien = $sinhVien->danhSachSinhVien;

        $lop = $sinhVien->danhSachSinhVien[0]->lop;
           
        $lopchuyenNganh = $lopCuaSinhVien->count()>1 
        ? $sinhVien->danhSachSinhVien[1]->lop
        : null;
       
        $nienKhoa = NienKhoa::findOrFail($lop->id_nien_khoa);
       
        $dsNam = collect();

        if ($nienKhoa) {
            $start = $nienKhoa->nam_bat_dau;
            $end = $nienKhoa->nam_ket_thuc+1;

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
       
        return view("client.xemdiem.ketquarenluyen", compact('sinhVien', 'dsDiemRenLuyen', 'dsNam', 'namDangChon','lopCuaSinhVien'));
    }
    
}