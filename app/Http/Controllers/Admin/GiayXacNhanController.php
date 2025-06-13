<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\DangKyGiay;
use App\Models\SinhVien;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoSo;

class GiayXacNhanController extends Controller
{
    public function index()
    {
        $dangkygiays = DangKyGiay::with('sinhVien', 'loaiGiay', 'giangVien', 'sinhVien.hoSo', 'giangVien.hoSo')
            ->orderBy('id', 'desc')
            ->get();
        return view("admin.testimonial.index", compact("dangkygiays"));
    }
    public function update($id)
    {
        $dangkygiay = DangKyGiay::findOrFail($id);

        $dangkygiay->trang_thai = 1;
        $dangkygiay->id_giang_vien = Auth::user()->id; 
        $dangkygiay->save();

        return redirect()->back()->with('success', 'Duyệt thành công!');
    }
}