<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\DangKyGiay;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GiayXacNhanController extends Controller
{
    // GET /api/admin/giay-xac-nhan
    public function index()
    {
        $dangkygiays = DangKyGiay::with('sinhVien', 'loaiGiay', 'giangVien', 'sinhVien.hoSo', 'giangVien.hoSo')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $dangkygiays,
        ]);
    }

    // PUT /api/admin/giay-xac-nhan/{id}
    public function update($id, $user_id)
    {
        $dangkygiay = DangKyGiay::find($id);

        if (!$dangkygiay) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy yêu cầu.',
            ], 404);
        }

        $dangkygiay->trang_thai = 1;
        $dangkygiay->id_giang_vien = $user_id;
        $dangkygiay->save();

        return response()->json([
            'status' => true,
            'message' => 'Duyệt thành công!',
            'data' => $dangkygiay,
        ]);
    }
}
