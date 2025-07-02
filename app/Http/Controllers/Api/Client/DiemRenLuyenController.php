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
use App\Http\Resources\Api\DiemRenLuyenResource;

class DiemRenLuyenController extends Controller
{
    public function index()
    {
        $diemRenLuyens = DiemRenLuyen::with(['nam'])
            ->where('id_sinh_vien', Auth::user()->id)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => DiemRenLuyenResource::collection($diemRenLuyens),
        ]);
    }
}