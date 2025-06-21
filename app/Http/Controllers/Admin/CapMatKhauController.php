<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\YeuCauCapLaiMatKhau;
use App\Models\User;
use App\Models\SinhVien;
use App\Http\Requests\CapMatKhau\SinhVienYeuCauRequest;
use App\Enum\LoaiTaiKhoan;

class CapMatKhauController extends Controller
{
    public function index(){
        $yeuCauCapLaiMatKhau = YeuCauCapLaiMatKhau::with('sinhvien','giangvien')->where('loai',LoaiTaiKhoan::EMAIL->value)->orderBy('trang_thai','asc')->get();
        return view('admin.capmatkhausinhvien.index',compact('yeuCauCapLaiMatKhau'));
    }

    public function update(YeuCauCapLaiMatKhau $capmatkhausinhvien){
        $result = $capmatkhausinhvien->update([
            'id_giang_vien' => Auth::user()->id,
            'trang_thai' => 1,
        ]);

        if(!$result) 
            return redirect()->route('giangvien.capmatkhausinhvien.index')->with('error', 'Cập nhật trạng thái thất bại');
        return redirect()->route('giangvien.capmatkhausinhvien.index')->with('success', 'Cập nhật trạng thái thành công');
    }
}
