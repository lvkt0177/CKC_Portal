<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\DangKyGiay;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GiayXacNhan\GiayXacNhanUpdate;
use Illuminate\Support\Arr;

class GiayXacNhanController extends Controller
{
    // GET /api/admin/giay-xac-nhan
    public function index()
    {
        $dangkygiays = DangKyGiay::with('loaiGiay','sinhVien.hoSo', 'giangVien.hoSo')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $dangkygiays,
        ]);
    }

    // PUT /api/admin/giay-xac-nhan/{id}
    public function update(GiayXacNhanUpdate $request)
    {
        try {
            $data = $request->validated();

            $ids = $data['ids'];
            $updateData = Arr::except($data, ['ids']);

            DangKyGiay::whereIn('id', $ids)->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật hàng loạt giấy xác nhận thành công.',
                'updated_ids' => $ids
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi cập nhật.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
