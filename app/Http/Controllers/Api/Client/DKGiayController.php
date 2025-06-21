<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SinhVien;
use App\Models\LoaiGiay;
use App\Models\DangKyGiay;
use Carbon\Carbon;

class DKGiayController extends Controller
{
    // api/sinhvien/dang-ky-giay
    public function index()
    {
        $id_sv = Auth::guard('student')->id();

        $sinhVien = SinhVien::with('hoSo', 'lop')->find($id_sv);
        $giayXacNhans = LoaiGiay::all();

        return response()->json([
            'success' => true,
            'sinh_vien' => $sinhVien,
            'loai_giay' => $giayXacNhans,
        ]);
    }

    // api/sinhvien/danh-sach-giay-da-dang-ky
    public function list()
    {
        $id_sv = Auth::user()->id;

        $dsgiay = DangKyGiay::with( 'loaiGiay','sinhVien.hoSo')
            ->where('id_sinh_vien', $id_sv)->get();

        return response()->json([
            'success' => true,
            'data' => $dsgiay,
            'id_sv' => $id_sv
        ]);
    }

    // api/sinhvien/dang-ky-giay
    public function store(Request $request)
    {
        $sinhVien = Auth::guard('student')->user();
        $giayIds = $request->input('document_type', []);

        if (empty($giayIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Chưa có loại giấy nào được chọn.',
            ], 400);
        }

        $ngayNhan = now()->addWeek();
        while (!in_array($ngayNhan->dayOfWeek, [Carbon::WEDNESDAY, Carbon::FRIDAY])) {
            $ngayNhan->addDay();
        }

        $daTonTai = [];
        $daDangKyMoi = [];

        foreach ($giayIds as $id_giay) {
            $daDangKy = DangKyGiay::where('id_sinh_vien', $sinhVien->id)
                ->where('id_loai_giay', $id_giay)
                ->where('trang_thai', 0)
                ->exists();

            if ($daDangKy) {
                $daTonTai[] = $id_giay;
                continue;
            }

            DangKyGiay::create([
                'id_sinh_vien' => $sinhVien->id,
                'id_giang_vien' => null,
                'id_loai_giay' => $id_giay,
                'ngay_dang_ky' => now(),
                'ngay_nhan' => $ngayNhan,
                'trang_thai' => 0,
            ]);

            $daDangKyMoi[] = $id_giay;
        }

        if (count($daTonTai) === count($giayIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Các giấy đã chọn đều đã được đăng ký và đang chờ xử lý.',
                'duplicated' => $daTonTai
            ], 409);
        }

        return response()->json([
            'success' => true,
            'message' => !empty($daTonTai)
                ? 'Một số giấy đã được đăng ký trước. Các giấy còn lại đã được đăng ký thành công.'
                : 'Đăng ký thành công.',
            'registered' => $daDangKyMoi,
            'duplicated' => $daTonTai
        ]);
    }
}
