<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NganhHoc;
use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\HoSo;
use App\Models\Lop;
use App\Models\BoMon;
use App\Models\NienKhoa;


class SinhVienController extends Controller
{
    public function index(Request $request)
    {

        $id_lop = $request->input('id_lop');
        $nienKhoas = NienKhoa::orderBy('id', 'desc')->get();
        $nganhHocs = NganhHoc::orderBy('id', 'desc')->get();

        // Nếu không chọn thì lấy id niên khóa mới nhất
        $id_nien_khoa = $request->input('id_nien_khoa') ?? $nienKhoas->first()->id;
        // Nếu không chọn ngành học thì hiện tất cả các ngành
        $id_nganh_hoc = $request->input('id_nganh_hoc');
        // Lấy danh sách lớp theo niên khóa
        $lops = Lop::with(['nienKhoa', 'giangVien', 'giangVien.boMon.nganhHoc'])
            ->where('id_nien_khoa', $id_nien_khoa)
            ->when($id_nganh_hoc, function ($query) use ($id_nganh_hoc) {
                return $query->whereHas('giangVien.boMon.nganhHoc', function ($q) use ($id_nganh_hoc) {
                    $q->where('id', $id_nganh_hoc);
                });
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.student.index', compact('lops', 'id_lop', 'nienKhoas', 'id_nien_khoa', 'id_nganh_hoc', 'nganhHocs'));

    }
    public function showlist(int $id)
    {
        $sinhviens = SinhVien::with(['hoSo', 'lop', 'lop.nienKhoa'])
            ->where('id_lop', $id)
            ->orderBy('ma_sv', 'asc')
            ->get();

        $lop = Lop::find($id);

        return view('admin.student.list', compact('sinhviens', 'lop'));
    }
}