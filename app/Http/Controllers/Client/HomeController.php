<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\SinhVien;
use App\Models\HocKy;
use App\Models\Lop;
use App\Models\Nam;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\NienKhoa;
use App\Models\DiemRenLuyen;
use App\Models\LopHocPhan;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lopHocPhanDangMo = LopHocPhan::with([
            'lop',
            'giangVien.hoSo',
            'thoiKhoaBieu.phong'
        ])->where('trang_thai', 1)->get();
    
        foreach ($lopHocPhanDangMo as $lop) {
            $tkbDauTien = $lop->thoiKhoaBieu->sortBy(fn($tkb) => $tkb->ngay)->first();
    
            if ($tkbDauTien) {
                $ngayKetThuc = Carbon::parse($tkbDauTien->ngay)->addWeeks(5);
    
                if (now()->greaterThanOrEqualTo($ngayKetThuc)) {
                    $lop->trang_thai = 0;
                    $lop->save(); 
                }
            }
        }

        return view('client.home.index');
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