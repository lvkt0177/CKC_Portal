<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\NganhHoc;
use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\HoSo;
use App\Models\Lop;
use App\Models\BoMon;
use App\Models\NienKhoa;
use App\Models\Permission;
use App\Models\Role;
use App\Http\Requests\SinhVien\ChucVuRequest;
use App\Enum\RoleStudent;

class SinhVienController extends Controller
{
    public function index(Request $request)
    {

        $id_lop = $request->input('id_lop');
        $nienKhoas = NienKhoa::orderBy('id', 'desc')->get();
        $nganhHocs = NganhHoc::orderBy('id', 'desc')->get();

        $id_nien_khoa = $request->input('id_nien_khoa') ?? NienKhoa::where('nam_bat_dau', '<', Carbon::now()->year)
            ->where('nam_ket_thuc', '>=', Carbon::now()->year)
            ->orderByDesc('nam_ket_thuc')
            ->first()?->id;
        $id_nganh_hoc = $request->input('id_nganh_hoc');
        $lops = Lop::with(['nienKhoa', 'giangVien', 'giangVien.boMon.nganhHoc'])
            ->where('id_nien_khoa', $id_nien_khoa)
            ->when($id_nganh_hoc, function ($query) use ($id_nganh_hoc) {
                return $query->whereHas('giangVien.boMon.nganhHoc', function ($q) use ($id_nganh_hoc) {
                    $q->where('id', $id_nganh_hoc);
                });
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.student.index', compact('lops', 'id_lop', 'nienKhoas', 'id_nien_khoa', 'id_nganh_hoc', 'nganhHocs'));

    }
    public function showlist(int $id)
    {
        $sinhviens = SinhVien::with(['hoSo', 'lop', 'lop.nienKhoa'])
            ->where('id_lop', $id)
            ->orderBy('ma_sv', 'asc')
            ->get();

        $lop = Lop::find($id);

        return view('admin.student.list', compact('sinhviens', 'lop'));
    }

    public function doiChucVu(ChucVuRequest $request, SinhVien $sinhVien)
    {
        $thuKy = SinhVien::where('id_lop', $sinhVien->id_lop)->where('chuc_vu', RoleStudent::SECRETARY)->first();
        if($thuKy) {
            $thuKy->chuc_vu = RoleStudent::MEMBER;
            //xoá quyền
            $thuKy->permissions()->detach(Permission::PERMISSION_SECRETARY_CREATE_REPORT);
            $thuKy->save();
        }

        if ($sinhVien->update($request->validated())) {
            // gắn quyền PERMISSION_SECRETARY_CREATE_REPORT cho sinh viên
            $sinhVien->permissions()->attach(Permission::PERMISSION_SECRETARY_CREATE_REPORT);
            return redirect()->back()->with('success', 'Cập nhật chức vụ cho sinh viên ' . $sinhVien->hoSo->ho_ten . ' thành công');
        }

        return redirect()->back()->with('error', 'Đổi chức vụ không thành công');
    }

    public function khoaSinhVien(SinhVien $sinhVien)
    {
        logger("Before: " . $sinhVien->trang_thai->value);

        $sinhVien->trang_thai = $sinhVien->trang_thai->value == 0 ? 1 : 0;

        logger("After: " . $sinhVien->trang_thai->value);

        if ($sinhVien->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Thay đổi trạng thái sinh viên thành công'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Khoá sinh viên không thành công'
        ]);
    }

}