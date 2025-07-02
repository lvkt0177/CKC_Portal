<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\HocKy;
use App\Models\MonHoc;
use App\Models\LopHocPhan;
use App\Models\DanhSachHocPhan;
use App\Models\ThoiKhoaBieu;
use App\Http\Resources\Api\LopHocPhanResource;
use App\Http\Resources\Api\ThoiKhoaBieuResource;

class ThoiKhoaBieuController extends Controller
{
    public function index()
    {
        $sinhVien = Auth::user();

        $thoiKhoaBieu = ThoiKhoaBieu::with(['lopHocPhan','phong','tuan'])
            ->whereHas('lopHocPhan.danhSachHocPhan', function ($query) use ($sinhVien) {
                $query->where('id_sinh_vien', $sinhVien->id);
            })
            ->get();
    
        return response()->json([
            'status' => true,
            'data' => ThoiKhoaBieuResource::collection($thoiKhoaBieu),
        ]);
    }



}