<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Khoa;
use App\Models\NganhHoc;
use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\HoSo;
use App\Models\Lop;
use App\Models\NienKhoa;


class SinhVienController extends Controller
{
    public function index(Request $request)
    {
        $id_khoa = $request->input('id_khoa');
        $nganhHocs = NganhHoc::orderBy('id', 'desc')->get();
        $id_lop = $request->input('id_lop');
        $nienKhoas = NienKhoa::orderBy('id', 'desc')->get();

        // Nếu không chọn thì lấy id niên khóa mới nhất
        $id_nien_khoa = $request->input('id_nien_khoa') ?? $nienKhoas->first()->id;
        
        // Lấy danh sách lớp theo niên khóa
        $lops = Lop::with(['nienKhoa', 'giangVien'])
            ->where('id_nien_khoa', $id_nien_khoa)
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.student.index', compact('lops', 'id_lop', 'nganhHocs', 'nienKhoas', 'id_nien_khoa'));

    }
    public function showlist(int $id)
    {
        $sinhviens = SinhVien::with(['hoSo', 'lop', 'lop.nienKhoa'])
            ->where('id_lop', $id)
            ->orderBy('ma_sv', 'asc')
            ->get();
        return view('admin.student.list', compact('sinhviens'));
    }
}