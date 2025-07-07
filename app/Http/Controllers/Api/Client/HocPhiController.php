<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\HocPhi;
use App\Models\SinhVien;
use App\Models\HocKy;
use App\Models\Lop;
use App\Models\NienKhoa;

class HocPhiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sinhVien = Auth::user();

        $sinhVien->load('danhSachSinhVien.lop');
        $now = now()->toDateString();
        $nienKhoa = NienKhoa::find($sinhVien->danhSachSinhVien->last()->lop->nienKhoa->id);

        $hocKyHienTai = HocKy::whereDate('ngay_bat_dau', '<=', $now)
            ->whereDate('ngay_ket_thuc', '>=', $now)
            ->where('id_nien_khoa', $nienKhoa->id)
            ->first();

        $hocPhi = null;
        
        if ($hocKyHienTai) {
            $hocPhi = HocPhi::firstOrCreate(
                [
                    'id_sinh_vien' => $sinhVien->id,
                    'id_hoc_ky' => $hocKyHienTai->id,
                ],
                [
                    'tong_tien' => 7700000,
                    'trang_thai' => 0,
                ]
            );
            
            if($hocPhi->trang_thai->value == 1)
            {
                $hocPhi = [];
            }
        }
        else
        {
            $hocPhi = HocPhi::with('hocKy')
                    ->where('id_sinh_vien', $sinhVien->id)
                    ->where('trang_thai', 0)
                    ->first();
        }
    
        return response()->json([
            'sinhVien' => $sinhVien,
            'hocKyHienTai' => $hocKyHienTai,
            'hocPhi' => $hocPhi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
