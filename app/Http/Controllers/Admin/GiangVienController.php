<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\HoSo;
use App\Models\BoMon;
use App\Models\NganhHoc;
use App\Models\Khoa;
class GiangVienController extends Controller
{
    public function index()
    {
        $users = User::with('hoSo', 'boMon', 'boMon.nganhHoc.khoa')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.teacher.index', compact('users'));
    }
}