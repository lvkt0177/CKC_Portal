<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\LopHocPhan;
use App\Models\HoSo;
use App\Models\DanhSachHocPhan;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GiangVien\NhapDiemRequest;

class DiemMonHocController extends Controller
{
    public function index(Request $request)
    {
        $id_giang_vien = Auth::user()->id;
        $id_lop = $request->input('lop');  

        $lop_hoc_phan = LopHocPhan::with([
            'lop',
        ])
            ->where('id_giang_vien', $id_giang_vien)
            ->get();

        if($id_lop) {
            $lop_hoc_phan = $lop_hoc_phan->where('id_lop', $id_lop);
        }

        return response()->json([
            'status' => true,
            'lop_hoc_phan' => $lop_hoc_phan,
        ]);
    }
    
    public function list(int $id)
    {
        $sinhviens = SinhVien::with([
            'hoSo',
            'lop.nienKhoa',
            'danhSachHocPhans.lopHocPhan'
        ])
            ->whereHas('danhSachHocPhans.lopHocPhan', function ($query) use ($id) {
                $query->where('id_lop_hoc_phan', $id);
            })
            ->orderBy('ma_sv', 'asc')
            ->get();

        $lop_HP = LopHocPhan::with('chuongTrinhDaoTao', 'lop')->find($id);

        return response()->json([
            'status' => true,
            'lop_hoc_phan' => $lop_HP,
            'sinh_viens' => $sinhviens
        ]);
    }

    public function capNhat(NhapDiemRequest $request)
    {
        $validated = $request->validated();
        $Students = $validated['students'] ?? [];
        $idLopHocPhan = $validated['id_lop_hoc_phan'];
        $chuyenCan = $validated['diem_chuyen_can'] ?? [];
        $quaTrinh = $validated['diem_qua_trinh'] ?? [];
        $thi = $validated['diem_thi'] ?? [];

        $updates = [];

        foreach ($Students as $idSinhVien) {
            $idSinhVien = (int) $idSinhVien;

            $cc = $chuyenCan[$idSinhVien] ?? null;
            $qt = $quaTrinh[$idSinhVien] ?? null;
            $dt = $thi[$idSinhVien] ?? null;

            $tongKet = (!is_null($cc) && !is_null($qt) && !is_null($dt))
                ? ($cc * 0.1 + $qt * 0.4 + $dt * 0.5)
                : null;

            $updates[] = [
                'id_sinh_vien' => $idSinhVien,
                'diem_chuyen_can' => $cc,
                'diem_qua_trinh' => $qt,
                'diem_thi' => $dt,
                'diem_tong_ket' => $tongKet,
            ];
        }

        foreach ($updates as $data) {
            DanhSachHocPhan::where('id_lop_hoc_phan', $idLopHocPhan)
                ->where('id_sinh_vien', $data['id_sinh_vien'])
                ->update([
                    'diem_chuyen_can' => $data['diem_chuyen_can'],
                    'diem_qua_trinh' => $data['diem_qua_trinh'],
                    'diem_thi' => $data['diem_thi'],
                    'diem_tong_ket' => $data['diem_tong_ket'],
                ]);
        }

        return response()->json([
            'message' => 'Cập nhật điểm thành công!',
            'status' => true
        ]);
    }
}