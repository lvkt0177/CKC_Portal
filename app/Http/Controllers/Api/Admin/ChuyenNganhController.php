<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Acl\Acl;
use App\Models\Khoa;


class ChuyenNganhController extends Controller
{
    public function index()
    {
        //
    }

    public function getChuyenNganhWithKhoa()
    {
        $chuyenNganh = ChuyenNganh::with('khoa')->get();
        return response()->json([
            'status' => true,
            'chuyenNganh' => $chuyenNganh
        ]);
    }

}