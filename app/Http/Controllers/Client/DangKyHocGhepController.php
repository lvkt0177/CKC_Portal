<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\SinhVien;
use App\Models\Lop;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\NienKhoa;
use App\Models\MonHoc;
use App\Models\DanhSachHocPhan;
use Illuminate\Support\Facades\DB;

class DangKyHocGhepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idSinhVien = Auth::guard('student')->id();
        
        $monHoc = DB::table('danh_sach_hoc_phan as dshp')
            ->join('lop_hoc_phan as lhp', 'lhp.id', '=', 'dshp.id_lop_hoc_phan')
            ->join('mon_hoc as mh', 'mh.ten_mon', '=', 'lhp.ten_hoc_phan')
            ->join('chi_tiet_ctdt as ct', 'ct.id_mon_hoc', '=', 'mh.id')
            ->where('dshp.id_sinh_vien', $idSinhVien)
            ->where('dshp.diem_tong_ket', '<', 5)
            ->select(
                'lhp.ten_hoc_phan as ten_mon',
                'dshp.diem_tong_ket',
                'ct.so_tin_chi'
            )
            ->distinct()
            ->get();

        return view('client.dangkyhocghep.index', compact('monHoc'));
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
