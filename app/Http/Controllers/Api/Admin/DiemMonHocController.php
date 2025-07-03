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
use App\Enum\NopBangDiemStatus;

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

    public function updateTrangThai(LopHocPhan $lopHocPhan)
    {
        $result = $this->capNhatTheoTrangThai($lopHocPhan->trang_thai_nop_bang_diem->value, $lopHocPhan) ? true : false;     
        
        if($result) {
            $lopHocPhan->trang_thai_nop_bang_diem = NopBangDiemStatus::from($lopHocPhan->trang_thai_nop_bang_diem->value + 1);
            $lopHocPhan->save();
            return response()->json([
                'status' => true,
                'message' => 'Nộp bảng điêm thành công!'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Nộp bảng điểm thất bại!'
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

    public function capNhatTheoTrangThai(int $trangThai,LopHocPhan $lopHocPhan){
       if($lopHocPhan->danhSachHocPhan->count() == 0) {
           return false;
       }

        foreach ($lopHocPhan->danhSachHocPhan as $sinhVien) {
            $idSinhVien = (int)$sinhVien->id_sinh_vien;

            $cc = (float)$sinhVien->diem_chuyen_can ?? 0;
            $qt = (float)$sinhVien->diem_qua_trinh ?? 0;
            $dt1 = $sinhVien->diem_thi_lan_1 ?? null;
            $dt2 = $sinhVien->diem_thi_lan_2 ?? null;
            
            $dt = $dt1;
            
            if($dt2 != null){
                $dt = $dt1 > $dt2 ? $dt1 : $dt2;
            }
            $tongKet = (!is_null($cc) && !is_null($qt) && !is_null($dt))
                ? ($cc * 0.1 + $qt * 0.4 + $dt * 0.5)
                : null;

            $updates[] = [
                'id_sinh_vien' => $idSinhVien,
                'diem_chuyen_can' => $cc,
                'diem_qua_trinh' => $qt,
                'diem_thi_lan_1' => $dt1,
                'diem_thi_lan_2' => $dt2,
                'diem_tong_ket' => $tongKet,
            ];
        }
        
        if ($trangThai == 1) {
            foreach ($updates as $data) {
                DanhSachHocPhan::where('id_lop_hoc_phan', $lopHocPhan->id)
                    ->where('id_sinh_vien', $data['id_sinh_vien'])
                    ->update([
                        'diem_chuyen_can' => $data['diem_chuyen_can'],
                        'diem_qua_trinh' => $data['diem_qua_trinh'],
                        'diem_thi_lan_1' => $data['diem_thi_lan_1'],
                        'diem_thi_lan_2' => $data['diem_thi_lan_2'],
                        'diem_tong_ket' => $data['diem_tong_ket'],
                    ]);
            }
        }
        return true;
    }
}