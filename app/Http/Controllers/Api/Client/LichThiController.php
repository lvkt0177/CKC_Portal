<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Lop;
use App\Models\Nam;
use App\Models\User;
use App\Models\HocKy;
use App\Models\MonHoc;
use App\Models\LichThi;
use App\Enum\XepLoaiDRL;
use App\Models\DiemRenLuyen;
use App\Models\DanhSachHocPhan;

class LichThiController extends Controller
{
    public function index()
    {
        $sinhVien = Auth::user()->danhSachSinhVien->last();
        
        $lichThi = LichThi::with('giamThi1.hoSo', 'giamThi2.hoSo','phong', 'lopHocPhan')
            ->whereHas('lopHocPhan', function ($query) use ($sinhVien) {
                $query->where('id_lop', $sinhVien->id_lop);
            })
            ->orderBy('ngay_thi')
            ->get();
        
        return response()->json([
            'status' => true,
            'data' => $lichThi
        ]);
    }

    public function listLichThiLanHai()
    {
        $sinhVien = Auth::guard('student')->user();
        
        $lichThi = LichThi::with([
            'giamThi1.hoSo',
            'giamThi2.hoSo',
            'phong',
            'lopHocPhan.dangKyHocGhepThiLai',
            'lopHocPhan.danhSachHocPhan' => function ($query) use ($sinhVien) {
                $query->where('id_sinh_vien', $sinhVien->id);
            },
        ])
            ->whereHas('lopHocPhan.danhSachHocPhan', function ($query) use ($sinhVien) {
                $query->where('id_sinh_vien', $sinhVien->id);
            })
            ->where('lan_thi', 2)
            ->orderBy('ngay_thi')
            ->get();
        
        return response()->json([
            'status' => true,
            'data' => $lichThi
        ]);
    }


}