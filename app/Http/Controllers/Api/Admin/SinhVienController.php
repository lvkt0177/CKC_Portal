<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\HoSo;
use App\Models\Lop;
use App\Models\BoMon;
use App\Models\NienKhoa;
use App\Http\Requests\SinhVien\ChucVuRequest;

class SinhVienController extends Controller
{
    // Lấy ra danh sách lớp theo Niên khoá hoặc Ngành Học
    public function index()
    {
        $query = Lop::with(['nienKhoa', 'giangVien.boMon.chuyenNganh'])
            ->orderBy('id', 'desc');
    
        $lops = $query->get();
        
        return response()->json([
            'success' => true,
            'lops' => $lops,
        ]);
    }

    // Lấy ra danh sách sinh viên thuộc Lớp(ID)
    public function showlist(int $id)
    {
        $sinhviens = SinhVien::with(['hoSo'])
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

    // Đổi chức vụ cho sinh viên
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
}
