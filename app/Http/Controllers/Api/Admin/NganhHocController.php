<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Acl\Acl;
use App\Models\Khoa;
use App\Models\NganhHoc;

class NganhHocController extends Controller
{
    public function index()
    {
        //
    }

    public function getNganhHocWithKhoa()
    {
        $nganhHoc = NganhHoc::with('khoa')->get();
        return response()->json([
            'status' => true,
            'nganhHoc' => $nganhHoc
        ]);
    }

}