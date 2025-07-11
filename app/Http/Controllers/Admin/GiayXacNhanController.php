<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\DangKyGiay;
use App\Models\SinhVien;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoSo;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use App\Acl\Acl;

class GiayXacNhanController extends Controller
{
    public function __construct() {
        $this->middleware('permission:' . Acl::PERMISSION_STUDENT_CONFIRMATION_LIST, ['only' => ['index']]);
        $this->middleware('permission:' . Acl::PERMISSION_STUDENT_CONFIRMATION_UPDATE, ['only' => ['update']]);
    }

    public function index()
    {
        $dangkygiays = DangKyGiay::with('sinhVien', 'loaiGiay', 'giangVien', 'sinhVien.hoSo', 'giangVien.hoSo')
            ->orderBy('trang_thai', 'asc')
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