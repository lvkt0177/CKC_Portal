<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\User;
use App\Models\NienKhoa;
use App\Models\SinhVien;
use App\Models\HoSo;

class LopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lops = Lop::with('giangVien', 'nienKhoa', 'giangVien.boMon.nganhHoc')
        ->where('id_gvcn', auth()->user()->id)
        ->orderBy('id', 'desc')
        ->get();

        return view('admin.class.index', compact('lops'));
    }

    public function list(Lop $lop)
    {
        $sinhViens = SinhVien::with(['hoSo', 'lop', 'lop.nienKhoa','lop.giangVien'])
        ->where('id_lop', $lop->id)
        ->orderBy('ma_sv', 'asc')->get();

        return view('admin.class.list', compact('sinhViens', 'lop'));
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
