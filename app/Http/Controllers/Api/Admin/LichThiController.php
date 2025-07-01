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
use App\Models\LichThi;
use App\Models\PhieuLenLop;
use App\Models\Phong;
use App\Models\Tuan;
use App\Acl\Acl;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LichThi\LichThiStoreRequestAPI;

class LichThiController extends Controller
{
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Lịch thi đã được tạo thành công.',
            'data' => $request->all()
        ], 201);
        $lichThi = LichThi::create($request->validated());

        if ($lichThi) {
            return response()->json([
                'message' => 'Lịch thi đã được tạo thành công.',
                'data' => $lichThi
            ], 201);
        } else {
            return response()->json([
                'message' => 'Không thể tạo lịch thi. Vui lòng thử lại sau.'
            ], 500);
        }
    }

    public function update()
    {

    }
    
    public function destroy()
    {

    }
  
}
