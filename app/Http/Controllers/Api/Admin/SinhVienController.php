<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\DanhSachSinhVien;
use App\Models\SinhVien;
use App\Models\HoSo;
use App\Models\Lop;
use App\Models\BoMon;
use App\Models\NienKhoa;
use App\Enum\RoleStudent;
use App\Http\Requests\SinhVien\ChucVuRequest;

class SinhVienController extends Controller
{
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

   // Lấy ra danh sách sinh viên thuộc Lớp (ID)
public function showlist(int $id)
{
    $lop = Lop::find($id);

    if (!$lop) {
        return response()->json([
            'success' => false,
            'message' => 'Lớp không tồn tại'
        ], 404);
    }

    $sinhViens = DanhSachSinhVien::with(['sinhVien.hoSo'])
        ->where('id_lop', $id)
        ->orderBy('id_sinh_vien', 'asc')
        ->get()
        ->map(function ($ds) {
            return [
                'id' => $ds->id,
                'id_lop' => $ds->id_lop,
                'id_sinh_vien' => $ds->id_sinh_vien,
                'chuc_vu' => $ds->chuc_vu?->value,
                'sinh_vien' => $ds->sinhVien,
            ];
        });

    return response()->json([
        'success' => true,
        'lop' => $lop,
        'sinh_viens' => $sinhViens
    ]);
}

public function doiChucVu(ChucVuRequest $request, $id)
{
    $dssv = DanhSachSinhVien::findOrFail($id);
    $data = $request->validated();

    if ($data['chuc_vu'] == 1) {
        DanhSachSinhVien::where('id_lop', $dssv->id_lop)
            ->where('chuc_vu', 1)
            ->update(['chuc_vu' => 0]);
    }

    $dssv->chuc_vu = $data['chuc_vu'];
    $dssv->save();

    $dssv_all = DanhSachSinhVien::where('id_lop', $dssv->id_lop)->get();

    return response()->json([
        'success' => true,
        'message' => 'Cập nhật chức vụ thành công',
        'dssv' => $dssv,
        'all_students' => $dssv_all,  
    ]);
}


}
