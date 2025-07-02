<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LichThi;
use App\Models\LopHocPhan;
use Illuminate\Support\Facades\Auth;

class LichThiController extends Controller
{
    //
    public function index()
    {
        $sinhVien = Auth::guard('student')->user();
        
        $lichThi = LichThi::with('giamThi1.hoSo', 'giamThi2.hoSo','phong', 'lopHocPhan')
            ->whereHas('lopHocPhan', function ($query) use ($sinhVien) {
                $query->where('id_lop', $sinhVien->id_lop);
            })
            ->orderBy('ngay_thi')
            ->get();

        return view("client.lichthi.index", compact('lichThi'));
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
        
        return view("client.lichthi.list", compact('lichThi'));
    }
}