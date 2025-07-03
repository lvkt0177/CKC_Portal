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

        $sinhVien->load('hoSo', 'lop', 'lopChuyenNganh');
        if (!$sinhVien) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy sinh viên.',
            ], 404);
        }
    
        $lop = optional($sinhVien->lop);
        if (!$lop || !$lop->id_nien_khoa) {
            return response()->json([
                'success' => false,
                'message' => 'Sinh viên chưa được phân lớp hoặc lớp thiếu thông tin niên khóa.',
            ], 400);
        }
    
        $nienkhoa = NienKhoa::find($lop->id_nien_khoa);
        if (!$nienkhoa) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy niên khóa.',
            ], 404);
        }
    
        $chuong_trinh_dao_tao = ChuongTrinhDaoTao::whereHas('chuyenNganh', function ($q) use ($lop) {
            $q->where('id_nganh_hoc', $lop->id_nganh_hoc);
        })->orderBy('id', 'asc')->first();
    
        if (!$chuong_trinh_dao_tao) {
            return response()->json([
                'success' => false,
                'message' => 'Không có chương trình đào tạo nào.',
            ]);
        }
    
        $ct_ctdt = ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao', 'hocKy'])
            ->where('id_chuong_trinh_dao_tao', $chuong_trinh_dao_tao->id)
            ->whereHas('hocKy', function ($q) use ($nienkhoa) {
                $q->where('id_nien_khoa', $nienkhoa->id);
            })
            ->get()
            ->groupBy('id_hoc_ky');
    
        $Mons = $ct_ctdt->flatten()->pluck('monHoc')->filter()->unique('id');
    
        $diemHocPhan = DanhSachHocPhan::where('id_sinh_vien', $sinhVien->id)
            ->whereHas('lopHocPhan', function ($q) use ($Mons, $lop) {
                $q->where('id_lop', $lop->id);
                if ($Mons->isNotEmpty()) {
                    foreach ($Mons as $mon) {
                        if ($mon && $mon->ten_mon) {
                            $q->orWhere('ten_hoc_phan', 'like', '%' . $mon->ten_mon . '%');
                        }
                    }
                }
            })
            ->with('lopHocPhan')
            ->get();
    
        $gradesData = $ct_ctdt->mapWithKeys(function ($dsMon, $idHocKy) use ($diemHocPhan) {
            return [
                $idHocKy => $dsMon->map(function ($ct) use ($diemHocPhan) {
                    $tenMon = optional($ct->monHoc)->ten_mon ?? '';
    
                    $diem = $diemHocPhan->first(function ($item) use ($tenMon) {
                        $tenFull = Str::of($tenMon)->trim()->lower();
                        $tenTrongDB = Str::of(optional($item->lopHocPhan)->ten_hoc_phan)->trim()->lower();
                        return $tenTrongDB == $tenFull;
                    });
    
                    return [
                        'ten_hoc_ky' => optional($ct->hocKy)->ten_hoc_ky ?? '',
                        'ten_mon' => $tenMon,
                        'tin_chi' => $ct->so_tin_chi,
                        'tongket' => optional($diem)->diem_tong_ket ?? '-',
                    ];
                }),
            ];
        });
    
        return response()->json([
            'success' => true,
            'ket_qua' => $gradesData,
        ]);
    }
    


}