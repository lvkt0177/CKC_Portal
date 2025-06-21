<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Acl\Acl;
use App\Models\NienKhoa;

class NienKhoaController extends Controller
{
    public function index()
    {
        //
    }

    public function getNienKhoaWithHocKy()
    {
        $nienkhoa = NienKhoa::with('hocKys')->get();
        return response()->json([
            'status' => true,
            'nienkhoa' => $nienkhoa
        ]);
    }

}