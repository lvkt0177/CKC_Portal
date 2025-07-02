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
use App\Enum\NopBangDiemStatus;

class DiemMonHocController extends Controller
{
    public function index()
    {
        $id_giang_vien = Auth::user()->id;
        $lop_hoc_phan = LopHocPhan::with([
            'lop',
        ])
            ->where('id_giang_vien', $id_giang_vien)
            ->orderBy('id_giang_vien', 'desc')
            ->get();
     
        return view('admin.diemmonhoc.index', compact('lop_hoc_phan'));

    }
    public function list(int $id)
    {
        $lop_HP = LopHocPhan::find($id);
        
        $sinhviens = SinhVien::with([
            'hoSo',
            'lop.nienKhoa',
            'danhSachHocPhans' => function ($query) use ($id) {
                $query->where('id_lop_hoc_phan', $id)->with('lopHocPhan');
            }
        ])
        ->whereHas('danhSachHocPhans.lopHocPhan', function ($query) use ($id) {
            $query->where('id_lop_hoc_phan', $id);
        })
        ->orderBy('ma_sv', 'asc')
        ->get();

        $currentTrangThai = $lop_HP->trang_thai_nop_bang_diem->value;

        $nextOption = collect(NopBangDiemStatus::cases())
            ->first(fn($case) => $case->value === $currentTrangThai + 1);

        return view('admin.diemmonhoc.list', compact('sinhviens', 'lop_HP', 'nextOption'));
    }

    public function updateTrangThai(LopHocPhan $lopHocPhan)
    {
        $lopHocPhan->trang_thai_nop_bang_diem = NopBangDiemStatus::from($lopHocPhan->trang_thai_nop_bang_diem->value + 1);
        $this->capNhatTheoTrangThai($lopHocPhan->trang_thai_nop_bang_diem->value, $lopHocPhan);     
        $lopHocPhan->save();
        
        return redirect()->back()->with('success', 'Cập nhật trạng thái nộp bảng điểm thành công!');  
    }

    public function capNhat(NhapDiemRequest $request)
    {
       
        $validated = $request->validated();
        $Students = $validated['students'] ?? [];
        $idLopHocPhan = $validated['id_lop_hoc_phan'];
        $chuyenCan = $validated['diem_chuyen_can'] ?? [];
        $quaTrinh = $validated['diem_qua_trinh'] ?? [];
        $thi1 = $validated['diem_thi_lan_1'] ?? [];
        $thi2 = $validated['diem_thi_lan_2'] ?? [];
        
        foreach ($Students as $idSinhVien) {
            $idSinhVien = (int)$idSinhVien;

            $cc = $chuyenCan[$idSinhVien] ?? null;
            $qt = $quaTrinh[$idSinhVien] ?? null;
            $dt1 = $thi1[$idSinhVien] ?? null;
            $dt2 = $thi2[$idSinhVien] ?? null;
            
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
   
    foreach ($updates as $data) {
        DanhSachHocPhan::where('id_lop_hoc_phan', $idLopHocPhan)
            ->where('id_sinh_vien', $data['id_sinh_vien'])
            ->update([
                'diem_chuyen_can' => $data['diem_chuyen_can'],
                'diem_qua_trinh' => $data['diem_qua_trinh'],
                'diem_thi_lan_1' => $data['diem_thi_lan_1'],
                'diem_thi_lan_2' => $data['diem_thi_lan_2'],
                'diem_tong_ket' => $data['diem_tong_ket'],
            ]);
    }


        return back()->with('success', 'Cập nhật điểm thành công!');
    }
    public function capNhatTheoTrangThai(int $trangThai,LopHocPhan $lopHocPhan){
       
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