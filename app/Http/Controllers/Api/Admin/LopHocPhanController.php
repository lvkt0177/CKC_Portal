<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\SinhVien;
use App\Models\DiemRenLuyen;
use App\Models\NienKhoa;
use App\Models\LopHocPhan;
use App\Models\Nam;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\ThoiKhoaBieu;
use App\Models\User;
use App\Enum\LoaiMonHoc;
use App\Models\DanhSachHocPhan;
use App\Models\DangKyHGTL;
use App\Models\PhieuLenLop;
use App\Models\MonHoc;
use App\Models\Phong;
use App\Models\Tuan;
use App\Acl\Acl;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LopHocPhan\PhanCongGiangVien;
use Illuminate\Support\Facades\Auth;

class LopHocPhanController extends Controller
{

    public function index()
    {
        $lopHocPhans = LopHocPhan::with(['thoiKhoaBieu.phong', 'giangVien.hoSo', 'lop.nienKhoa', 'chuongTrinhDaoTao.chiTietChuongTrinhDaoTao'])
            ->orderBy('id', 'desc')
            ->get();
        
        $monHocs = MonHoc::get();

        $nienKhoa = NienKhoa::get();
        
        return response()->json([
            'status' => 'success',
            'data' => $lopHocPhans,
            'nienKhoa' => $nienKhoa,
        ]);
    }

    public function lopHocPhanTheoGiangVien()
    {
        $lopHocPhans = LopHocPhan::with(['thoiKhoaBieu.phong', 'giangVien.hoSo', 'lop.nienKhoa', 'chuongTrinhDaoTao'])
            ->where('id_giang_vien', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $lopHocPhans,
        ]);
    }

    public function phanCongGiangVien(PhanCongGiangVien $request, LopHocPhan $lopHocPhan)
    {
        $lopHocPhan->id_giang_vien = $request->id_giang_vien;
        $lopHocPhan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Giảng viên đã được phân công thành công',
            'data' => $lopHocPhan
        ]);
    }
  
}
