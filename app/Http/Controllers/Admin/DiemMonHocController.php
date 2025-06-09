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

        $dsHocPhan = DanhSachHocPhan::get();
        $id_sinh_vien = $request->validated('id_sinh_vien');
        $id_lop_hoc_phan = $request->validated('id_lop_hoc_phan');

        if (!$id_sinh_vien) {
            return back()->with('error', 'Không nhận được ID sinh viên!');
        }
        if (!is_null($request->validated('diem_chuyen_can'))) {
            $dsHocPhan->diem_chuyen_can = $request->diem_chuyen_can;
        }

        if (!is_null($request->validated('diem_qua_trinh'))) {
            $dsHocPhan->diem_qua_trinh = $request->diem_qua_trinh;
        }

        if (!is_null($request->validated('diem_thi'))) {
            $dsHocPhan->diem_thi = $request->diem_thi;
        }

        $data = array_intersect_key(
            $request->validated(),
            array_flip(['diem_chuyen_can', 'diem_qua_trinh', 'diem_thi'])
        );


        $data['diem_tong_ket'] = $request->validated('diem_chuyen_can') * 0.1
            + $request->validated('diem_qua_trinh') * 0.4
            + $request->validated('diem_thi') * 0.5;
        DanhSachHocPhan::where('id_sinh_vien', $id_sinh_vien)
            ->where('id_lop_hoc_phan', $id_lop_hoc_phan)
            ->update($data);
        return back()->with('success', 'Cập nhật điểm thành công!');
    }
}