<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Model
use App\Models\SinhVien;
use App\Models\LopHocPhan;
use App\Models\HoSo;
use App\Models\DanhSachHocPhan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\GiangVien\NhapDiemRequest;

class DiemMonHocController extends Controller
{
    public function index()
    {
        $id_giang_vien = Auth::user()->id;
        $lop_hoc_phan = LopHocPhan::with([
            'chuongTrinhDaoTao',
            'lop',
            'chuongTrinhDaoTao.chiTietChuongTrinhDaoTao',
            'giangVien',
            'giangVien.hoSo'
        ])
            ->where('id_giang_vien', $id_giang_vien)
            ->orderBy('id_giang_vien', 'desc')
            ->get();

        $danh_sach_HP = DanhSachHocPhan::with(['lopHocPhan', 'sinhVien', 'sinhVien.hoSo'])
            ->get();
        return view('admin.diemmonhoc.index', compact('danh_sach_HP', 'lop_hoc_phan'));

    }
    public function list(int $id)
    {
        $sinhviens = SinhVien::with([
            'hoSo',
            'lop',
            'lop.nienKhoa',
            'danhSachHocPhans',
            'danhSachHocPhans.lopHocPhan'
        ])
            ->whereHas('danhSachHocPhans.lopHocPhan', function ($query) use ($id) {
                $query->where('id_lop_hoc_phan', $id);
            })
            ->orderBy('ma_sv', 'asc')
            ->get();


        $lop_HP = LopHocPhan::find($id);
        return view('admin.diemmonhoc.list', compact('sinhviens', 'lop_HP'));
    }
    public function capNhat(NhapDiemRequest $request)
    {
       
        $validated = $request->validated();
        $Students = $validated['students'] ?? [];
        $idLopHocPhan = $validated['id_lop_hoc_phan'];
        $chuyenCan = $validated['diem_chuyen_can'] ?? [];
        $quaTrinh = $validated['diem_qua_trinh'] ?? [];
        $thi = $validated['diem_thi'] ?? [];
       
        foreach ($Students as $idSinhVien) {
        $idSinhVien = (int)$idSinhVien;

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


        return back()->with('success', 'Cập nhật điểm thành công!');
    }
}