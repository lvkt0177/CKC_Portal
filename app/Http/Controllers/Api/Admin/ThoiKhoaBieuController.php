<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\SinhVien;
use App\Models\DiemRenLuyen;
use App\Models\NienKhoa;
use App\Models\LopHocPhan;
use App\Models\Nam;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\ThoiKhoaBieu;
use App\Models\User;
use App\Enum\LoaiMonHoc;
use App\Models\DanhSachHocPhan;
use App\Models\DangKyHGTL;
use App\Models\PhieuLenLop;
use App\Models\Phong;
use App\Models\Tuan;
use App\Acl\Acl;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ThoiKhoaBieu\ThoiKhoaBieuStoreRequestAPI;
use App\Http\Requests\ThoiKhoaBieu\ThoiKhoaBieuUpdateRequestAPI;
use Illuminate\Support\Facades\Auth;
use App\Services\ThoiKhoaBieuService;
use Illuminate\Auth\Access\Gate as AuthGate;
use App\Http\Requests\ThoiKhoaBieu\CopyWeekRequestAPI;

class ThoiKhoaBieuController extends Controller
{

    public function index()
    {
        $thoiKhoaBieus = ThoiKhoaBieu::with([
            'lopHocPhan.giangVien',
            'phong',
            'tuan',
        ])
        ->orderBy('id', 'desc')
        ->get();

        return response()->json([
            'message' => 'Lấy danh sách thời khóa biểu thành công.',
            'data' => $thoiKhoaBieus,
        ]);
    }

    public function thoiKhoaBieuCuaGiangVien()
    {
        $user = Auth::user();
        $thoiKhoaBieus = ThoiKhoaBieu::with([
            'lopHocPhan.giangVien',
            'phong',
            'tuan',
        ])->whereHas('lopHocPhan.giangVien', function ($query) use ($user) {
            $query->where('id', $user->id);
        })
        ->orderBy('id', 'desc')
        ->get();
        

        return response()->json([
            'message' => 'Lấy thời khóa biểu của giảng viên thành công.',
            'data' => $thoiKhoaBieus,
        ]);
    }

    public function store(ThoiKhoaBieuStoreRequestAPI $request, ThoiKhoaBieuService $service)
    {
        $data = $request->validated();

        if ($service->isTrungTiet($data)) {
            return response()->json([
                'message' => 'Thời khoá biểu này đã bị trùng với tiết học khác. Vui lòng chỉnh sửa lại.',
            ], 422);
        }

        $tkb = ThoiKhoaBieu::create($data);

        return response()->json([
            'message' => 'Tạo thời khóa biểu thành công.',
            'data' => $tkb,
        ], 201);
    }

    public function update(ThoiKhoaBieuUpdateRequestAPI $request, ThoiKhoaBieuService $service, ThoiKhoaBieu $tkb)
    {
        $data = $request->validated();

        if ($service->isTrungTiet($data, $tkb->id)) {
            return response()->json([
                'message' => 'Trùng tiết với thời khóa biểu khác.',
            ], 422);
        }

        $tkb->update($data);

        return response()->json([
            'message' => 'Cập nhật thành công.',
            'data' => $tkb,
        ]);
    }

    public function copyWeekToWeek(CopyWeekRequestAPI $request, ThoiKhoaBieu $tkb)
    {
        $data = $request->validated();
        $idTuan = $data['id_tuan'];

        $newTkb = $tkb->replicate();
        $newTkb->tuan_id = $idTuan;
        $newTkb->save();

        return response()->json([
            'message' => 'Sao chép thời khóa biểu thành công.',
            'data' => $newTkb,
        ], 201);
    }

    public function destroy(ThoiKhoaBieu $tkb)
    {
        $tkb->delete();
        return response()->json(['message' => 'Xoá thành công.']);
    }
  
}
