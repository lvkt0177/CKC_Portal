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
use Illuminate\Support\Facades\DB;

class XemDiemController extends Controller
{
    public function ketquahoctap(){
        $id_sv = Auth::guard('student')->user()->id;

        $sinhVien = SinhVien::with('hoSo', 'danhSachSinhVien.lop')->findOrFail($id_sv);
        
        $lopCuaSinhVien = $sinhVien->danhSachSinhVien;

        $lop = $sinhVien->danhSachSinhVien[0]->lop;
           
        $lopchuyenNganh = $lopCuaSinhVien->count()>1 
        ? $sinhVien->danhSachSinhVien[1]->lop
        : null;
       
        $nienkhoa = NienKhoa::findOrFail($lop->id_nien_khoa);
    
        $chuong_trinh_dao_tao_md = ChuongTrinhDaoTao::whereHas('chuyenNganh', function ($q) use ($lop) {
            $q->where('id_chuyen_nganh', $lop->id_chuyen_nganh);
        })->orderBy('id', 'asc')->first();
        
        $chuong_trinh_dao_tao_cn = $lopCuaSinhVien->count()>1 ? ChuongTrinhDaoTao::whereHas('chuyenNganh', function ($q) use ($lopchuyenNganh) {
            $q->where('id_chuyen_nganh', $lopchuyenNganh->id_chuyen_nganh);
        })->orderBy('id', 'asc')->first():null;
    
        $ct_ctdt_md = ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao', 'hocKy'])
            ->where('id_chuong_trinh_dao_tao', $chuong_trinh_dao_tao_md->id)
            ->whereHas('hocKy', function ($q) use ($nienkhoa) {
                $q->where('id_nien_khoa', $nienkhoa->id);
            })
            ->get();
        
        $ct_ctdt_cn = $lopCuaSinhVien->count()>1 ? ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao', 'hocKy'])
            ->where('id_chuong_trinh_dao_tao', $chuong_trinh_dao_tao_cn->id)
            ->whereHas('hocKy', function ($q) use ($nienkhoa) {
                $q->where('id_nien_khoa', $nienkhoa->id);
            })
            ->get()
            :collect();    
           
        $ct_ctdt_all = $ct_ctdt_md->merge($ct_ctdt_cn);
        $ct_ctdt_all = $ct_ctdt_all->flatten(1);
        $ct_ctdt_all = $ct_ctdt_all->groupBy('id_hoc_ky');
    
        $Mons = $ct_ctdt_all->flatten()->pluck('monHoc')->filter()->unique();
      
            
        $diemHocPhan = DanhSachHocPhan::where('id_sinh_vien', $id_sv)
                ->whereHas('lopHocPhan', function ($q) use ($Mons,$lop) {
                    $q->where('id_lop', $lop->id);
                    foreach ($Mons as $mon) {
                        $q->orWhere('ten_hoc_phan', 'like', '%' . $mon->ten_mon . '%');
                    }
                })
                ->with('lopHocPhan')
                ->get();
       
        $gradesData = $ct_ctdt_all->mapWithKeys(function ($dsMon, $idHocKy) use ($diemHocPhan,$lop) {
            return [
                $idHocKy => $dsMon->map(function ($ct) use ($diemHocPhan,$lop) {
                    $tenMon = $ct->monHoc->ten_mon ?? '';
                    $tenLop = $lop->ten_lop ?? '';
                    $diem = $diemHocPhan->first(function ($item) use ($tenMon, $tenLop) {
                        $tenFull = Str::of($tenMon . ' ' . $tenLop)->trim()->lower();
                        
                        $tenTrongDB = Str::of($item->lopHocPhan->ten_hoc_phan)->trim()->lower();
                        
                        return $tenTrongDB == $tenFull;
                    })?? null;  
                  
                    return [
                        'ten_hoc_ky' => $ct->hocKy->ten_hoc_ky ?? '',
                        'ten_mon' => $tenMon,
                        'tin_chi' => $ct->so_tin_chi,
                        'tongket'   => $diem->diem_tong_ket ?? '-',
                    ];
                })
            ];
        });
        
        $thongKeTungKy = [];

        foreach ($ct_ctdt_all as $idHocKy => $dsMon) {
            
            $tongTinChi = $dsMon->sum('so_tin_chi');
            $tongTiet = $dsMon->sum('so_tiet');
            $soMon = count($dsMon);
            $tenHK = $dsMon->first()->hocKy->ten_hoc_ky;    
            
            $dsMonCoDiem = LopHocPhan::with('danhSachHocPhan')
                        ->where('id_lop', $lop->id)
                        ->whereHas('danhSachHocPhan', function ($query) use ($id_sv) {
                            $query->where('id_sinh_vien', $id_sv)
                                ->wherenotNull('diem_tong_ket');
                        })
                        ->get();
            
            foreach($dsMonCoDiem as $item){
              
                $tongDiem =$item->danhSachHocPhan->sum('diem_tong_ket');
            }
          
        
            
            $soMonCoDiem = $dsMonCoDiem->count();
            
            $diemTB = $soMonCoDiem > 0 ? round($tongDiem / $soMonCoDiem, 2) : '-';
            

            $thongKeTungKy[$idHocKy] = [
                'so_mon' => $soMon,
                'tong_tin_chi' => $tongTinChi,
                'diem_trung_binh' => $diemTB,
                'ten_hoc_ky' => $tenHK
            ];

            if (in_array($tenHK, ['Học kỳ 2', 'Học kỳ 4', 'Học kỳ 6'])) {

                preg_match('/\d+/', $tenHK, $matches);
                
                $soHocKy = (int)($matches[0] ?? 0);

                $tenKyTruoc = 'Học kỳ ' . ($soHocKy - 1);

           
                if (
                    isset($thongKeTungKy[$tenKyTruoc]) &&
                    is_numeric($thongKeTungKy[$tenKyTruoc]['diem_trung_binh']) &&
                    is_numeric($diemTB)
                ) {
                    $trungBinhCaNam = round(
                        ($diemTB + $thongKeTungKy[$tenKyTruoc]['diem_trung_binh']) / 2,
                        2
                    );

                    $thongKeTungKy[$tenHK]['diem_trung_binh_ca_nam'] = $trungBinhCaNam;
                } else {
                    $thongKeTungKy[$tenHK]['diem_trung_binh_ca_nam'] = '-';
                }
            }
        }
        return view("client.xemdiem.ketquahoctap", compact('sinhVien','gradesData','thongKeTungKy','lopCuaSinhVien'));
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