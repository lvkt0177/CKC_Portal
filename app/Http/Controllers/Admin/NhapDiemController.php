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

class NhapDiemController extends Controller
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
        return view('admin.enterpoint.index', compact('danh_sach_HP', 'lop_hoc_phan'));

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
        return view('admin.enterpoint.list', compact('sinhviens', 'lop_HP'));
    }
    public function capNhat(Request $request)
    {
        $id_sinh_vien = $request->input('id_sinh_vien');
        //$id_lop_hoc_phan = $request->input('id_lop_hoc_phan');
        $dshp = DanhSachHocPhan::where('id_sinh_vien', $id_sinh_vien)
            ->first();
        dd($dshp);
        if ($dshp) {

            $dshp->diem_chuyen_can = $request->input('diem_chuyen_can');
            $dshp->diem_qua_trinh = $request->input('diem_qua_trinh');
            $dshp->diem_thi = $request->input('diem_thi');

            // Tính điểm tổng kết nếu muốn
            $dshp->diem_tong_ket = $this->tinhDiemTongKet($dshp);

            $dshp->save();
        } else {
            dd("Chua tim thay");
        }
        return back()->with('success', 'Cập nhật điểm thành công!');
    }

    private function tinhDiemTongKet($dshp)
    {
        return round(($dshp->diem_chuyen_can * 0.1) + ($dshp->diem_qua_trinh * 0.4) + ($dshp->diem_thi * 0.5), 2);
    }

}