<?php

namespace App\Http\Controllers\Client;

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
        $sinhVien = Auth::guard('student')->user();
        $sinhVien->load('danhSachSinhVien.lop');
        $now = now()->toDateString();
        $lop = $sinhVien->danhSachSinhVien[0]->lop;

        $nienKhoa = $lop->nienKhoa;

        $tatCaHocKy = HocKy::where('id_nien_khoa', $nienKhoa->id)
            ->orderBy('ngay_bat_dau')
            ->get();

        foreach ($tatCaHocKy as $hocKy) {
            if ($hocKy->ngay_bat_dau <= $now) {
                $hocPhi = HocPhi::firstOrCreate(
                    [
                        'id_sinh_vien' => $sinhVien->id,
                        'id_hoc_ky' => $hocKy->id,
                    ],
                    [
                        'tong_tien' => 7700000,
                        'trang_thai' => 0,
                    ]
                );
            }
        }
        $hocPhiCuaSinhVien = HocPhi::with('hocKy')->where('id_sinh_vien', $sinhVien->id)->orderBy('id_hoc_ky','asc')->get();
        return view('client.hocphi.index', compact('sinhVien', 'tatCaHocKy', 'hocPhiCuaSinhVien'));
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
