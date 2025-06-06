<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BienBanSHCN;
use App\Models\SinhVien;
use App\Models\User;
use App\Models\Tuan;
use App\Models\Lop;
use App\Models\HoSo;

class BienBanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $lop = Lop::where('id_gvcn', auth()->user()->id)->first();

        //ông A chủ nhiệm lớp A -> idLop = A -> bbSHCN == lớp A
        //ông B chủ nhiệm lớp A -> idLop = A -> bbSHCN == lớp A

        $bienBanSHCN = BienBanSHCN::with('lop','sv','tuan','gvcn','sv.hoSo')
        ->where('id_lop', $lop->id)
        ->orderBy('id', 'asc')
        ->get();

        return view('admin.bienbanshcn.index', compact('bienBanSHCN', 'lop'));
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
