<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\DanhSachHocPhan;
use App\Models\Lop;
use App\Models\DiemRenLuyen;
use App\Models\Nam;
use App\Models\User;
use App\Enum\XepLoaiDRL;


class ThongTinGiangVienController extends Controller
{
    public function index()
    {
        $giangVien = User::with(['hoSo'])
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $giangVien,
        ]);
    }
}