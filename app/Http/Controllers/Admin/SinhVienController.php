<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\DanhSachSinhVien;
use App\Models\HoSo;
use App\Models\Lop;
use App\Models\BoMon;
use App\Models\NienKhoa;
use App\Models\ChuyenNganh;
use App\Http\Requests\SinhVien\ChucVuRequest;
use App\Enum\RoleStudent;
use App\Acl\Acl;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;

class SinhVienController extends Controller
{
    public function index(Request $request)
    {
       
        $id_lop = $request->input('id_lop');
        $nienKhoas = NienKhoa::orderBy('id', 'desc')->get();
        $nganhHocs = ChuyenNganh::select('ten_chuyen_nganh')
                ->distinct()
                ->get();


        $ten_chuyen_nganh = $request->input('ten_chuyen_nganh');
                
        $id_nien_khoa = $request->input('id_nien_khoa') ?? NienKhoa::where('nam_bat_dau', '<', Carbon::now()->year)
            ->where('nam_ket_thuc', '>=', Carbon::now()->year)
            ->orderByDesc('nam_ket_thuc')
            ->first()?->id;
        
        $lops = Lop::with(['nienKhoa', 'giangVien', 'chuyenNganh'])
            ->where('id_nien_khoa', $id_nien_khoa)
            ->when($ten_chuyen_nganh, function ($query) use ($ten_chuyen_nganh) {
                $query->whereHas('chuyenNganh', function ($q) use ($ten_chuyen_nganh) {
                    $q->where('ten_chuyen_nganh', $ten_chuyen_nganh);
                });
            })
            ->orderByDesc('id')
            ->get();
        
        return view('admin.student.index', compact('lops', 'id_lop', 'nienKhoas', 'id_nien_khoa', 'ten_chuyen_nganh', 'nganhHocs'));
    }
    public function showlist(int $id)
    {
        $sinhviens = DanhSachSinhVien::with(['sinhVien.hoSo','lop.nienKhoa'])
            ->where('id_lop', $id)
            ->whereHas('sinhVien', function ($query) {
                $query->orderBy('ma_sv', 'asc'); }) 
            ->get();

        $lop = Lop::find($id);

        return view('admin.student.list', compact('sinhviens', 'lop'));
    }
    public function doiChucVu(ChucVuRequest $request, DanhSachSinhVien $danhSachSinhVien)
    {
        $permissionId = Permission::where('name', Acl::PERMISSION_SECRETARY_CREATE_REPORT)->value('id');

        if (!$permissionId) {
            return redirect()->back()->with('error', 'Không tìm thấy quyền thư ký tạo biên bản');
        }
        
        if($danhSachSinhVien) {
            $danhSachSinhVien->chuc_vu = $danhSachSinhVien->chuc_vu == RoleStudent::MEMBER ? RoleStudent::SECRETARY : RoleStudent::MEMBER;
            if($danhSachSinhVien->chuc_vu == RoleStudent::MEMBER)
                $danhSachSinhVien->permissions()->detach($permissionId);
            else
                $danhSachSinhVien->permissions()->syncWithoutDetaching([$permissionId]);
            $danhSachSinhVien->save();
        }
        
        $thuKy = DanhSachSinhVien::where('id_lop', $danhSachSinhVien->id_lop)
            ->where('chuc_vu', RoleStudent::SECRETARY)
            ->where('id', '!=', $danhSachSinhVien->id)
            ->first();

        if ($thuKy) {
            $thuKy->chuc_vu = RoleStudent::MEMBER;
            $thuKy->permissions()->detach($permissionId);
            $thuKy->save();
        }

        return redirect()->back()->with(
            'success',
            'Cập nhật chức vụ cho sinh viên ' . $danhSachSinhVien->sinhVien->hoSo->ho_ten . ' thành công'
        );
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