<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\DanhSachHocPhan;
use App\Models\SinhVien;
use App\Models\NienKhoa;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\MonHoc;
use App\Models\ChuongTrinhDaoTao;
use App\Models\LopHocPhan;
use App\Models\Lop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KetQuaHocTapController extends Controller
{
    public function index()
    {
        $sinhVien = Auth::user();
        $sinhVien = SinhVien::with('danhSachSinhVien')->findOrFail($sinhVien->id);
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

        $id_ctdtsChuaTao = $lopHocPhanChuaTao ? $lopHocPhanChuaTao->chuyenNganh->chuongTrinhDaoTao->first() : null;
    
        $id_ctdts = $id_ctdtsChuaTao ? $id_ctdtsDaTao->merge($id_ctdtsChuaTao->id)->unique()->values() : $id_ctdtsDaTao->unique()->values();

        $chiTietCTDT = ChiTietChuongTrinhDaoTao::whereIn('id_chuong_trinh_dao_tao', $id_ctdts)->whereHas('hocKy', fn($q) => $q->where('id_nien_khoa', $ids_nien_khoa))
        ->get();
        
        $diemCacMon = DanhSachHocPhan::with('lopHocPhan')
            ->where('id_sinh_vien', $sinhVien->id)
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
    
        return response()->json([
            'success' => true,
            'monTheoHocKy' => $monTheoHocKy
        ]);
    }
    


}