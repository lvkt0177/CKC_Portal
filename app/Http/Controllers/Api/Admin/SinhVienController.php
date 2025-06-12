<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\NganhHoc;
use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\HoSo;
use App\Models\Lop;
use App\Models\BoMon;
use App\Models\NienKhoa;
use App\Http\Requests\SinhVien\ChucVuRequest;

class SinhVienController extends Controller
{
    // api/admin/student
    public function index()
    {
        $nienKhoas = NienKhoa::orderBy('id', 'desc')->get();
        $nganhHocs = NganhHoc::orderBy('id', 'desc')->get();

        $lops = Lop::with(['nienKhoa', 'giangVien', 'giangVien.boMon.nganhHoc'])
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'lops' => $lops,
            'nien_khoas' => $nienKhoas,
            'nganh_hocs' => $nganhHocs
        ]);
    }

    // api/admin/student/{id}
    public function showlist(int $id)
    {
        $sinhviens = SinhVien::with(['hoSo', 'lop', 'lop.nienKhoa'])
            ->where('id_lop', $id)
            ->orderBy('ma_sv', 'asc')
            ->get();

        $lop = Lop::find($id);

        if (!$lop) {
            return response()->json([
                'success' => false,
                'message' => 'Lớp không tồn tại'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'lop' => $lop,
            'sinh_viens' => $sinhviens
        ]);
    }

    // api/admin/student/{sinhVien}/chucvu
    public function doiChucVu(ChucVuRequest $request, SinhVien $sinhVien)
    {
        if ($sinhVien->update($request->validated())) {
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật chức vụ thành công',
                'sinh_vien' => $sinhVien
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Đổi chức vụ không thành công'
        ]);
    }

    // api/admin/student/{sinhVien}/khoa
    public function khoaSinhVien(SinhVien $sinhVien)
    {
        $sinhVien->trang_thai = $sinhVien->trang_thai->value == 0 ? 1 : 0;

        if ($sinhVien->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Thay đổi trạng thái thành công',
                'trang_thai' => $sinhVien->trang_thai
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không thể thay đổi trạng thái'
        ]);
    }
}
