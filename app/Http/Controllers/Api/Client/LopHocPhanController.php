<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Lop;
use App\Models\HocKy;
use App\Models\LichThi;
use App\Models\LopHocPhan;
use App\Models\DanhSachHocPhan;

class LopHocPhanController extends Controller
{
    public function index()
    {
        $sinhVien = Auth::user();
        $lopHocPhan = LopHocPhan::with(['monHoc', 'giangVien', 'lop'])
            ->whereHas('danhSachHocPhan', function ($query) use ($sinhVien) {
                $query->where('id_sinh_vien', $sinhVien->id);
            })
            ->get();

        return response()->json([
            'status' => true,
            'data' => $lopHocPhan
        ]);
    }


}