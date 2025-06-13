<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\SinhVien;
use App\Models\DiemRenLuyen;
use App\Http\Requests\GiangVien\NhapDiemRequest;
use Illuminate\Support\Facades\Auth;

class LopController extends Controller
{
    // Lấy danh sách lớp của giảng viên đang đăng nhập
    public function index()
    {
        $lops = Lop::with('giangVien', 'nienKhoa', 'giangVien.boMon.nganhHoc')
            ->where('id_gvcn', auth()->id())
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $lops
        ]);
    }

    // Lấy danh sách sinh viên trong lớp cụ thể
    public function list(Lop $lop)
    {
        $sinhViens = SinhVien::with(['hoSo', 'lop', 'lop.nienKhoa', 'lop.giangVien'])
            ->where('id_lop', $lop->id)
            ->orderBy('ma_sv', 'asc')
            ->get();

        return response()->json([
            'lop' => $lop,
            'sinh_viens' => $sinhViens
        ]);
    }

    // Lấy danh sách sinh viên và điểm rèn luyện của từng người theo tháng
    public function nhapDiemRL(Request $request, Lop $lop)
    {
        $thang = $request->get('thoi_gian', now()->month);

        $sinhViens = SinhVien::with([
            'hoSo',
            'lop',
            'lop.nienKhoa',
            'lop.giangVien',
            'diemRenLuyens' => function ($query) use ($thang) {
                $query->where('thoi_gian', $thang);
            }
        ])
            ->where('id_lop', $lop->id)
            ->orderBy('ma_sv', 'asc')
            ->get();

        return response()->json([
            'lop' => $lop,
            'thoi_gian' => $thang,
            'sinh_viens' => $sinhViens
        ]);
    }

    // Cập nhật điểm rèn luyện
    public function capNhatDiemRL(NhapDiemRequest $request)
    {
        $data = $request->validated();
        $data['id_gvcn'] = auth()->id();

        DiemRenLuyen::updateOrCreate(
            [
                'id_sinh_vien' => $data['id_sinh_vien'],
                'thoi_gian' => $data['thoi_gian'],
            ],
            $data
        );

        return response()->json([
            'message' => 'Cập nhật điểm thành công!'
        ]);
    }

  
}
