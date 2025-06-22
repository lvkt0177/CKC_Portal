<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Acl\Acl;
use App\Models\NienKhoa;
use App\Models\BoMon;   

class BoMonController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function getBoMonWithRelation()
    {
        $bomon = BoMon::with('nganhHoc.khoa')->get();
        return response()->json([
            'status' => true,
            'bomon' => $bomon
        ]);
    }

}