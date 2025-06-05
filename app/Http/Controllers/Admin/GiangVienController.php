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
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use App\Acl\Acl;

class GiangVienController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:' . Acl::PERMISSION_USER_LIST, ['only' => ['index', 'show']]);
        
    }
    public function index()
    {
        $users = User::with('hoSo', 'boMon', 'boMon.nganhHoc.khoa')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.teacher.index', compact('users'));
    }

    //show
    public function show($id)
    {
        $data = User::with('hoSo', 'boMon', 'boMon.nganhHoc.khoa')
            ->where('id', $id)
            ->orderBy('id', 'desc')
            ->get();

        if ($data->isEmpty()) {
            return redirect()->route('admin.giangvien.index')->with('error', 'Giảng viên không tồn tại.');
        }

        $user = $data[0];
        $roles = Role::all();

        return view('admin.teacher.show', compact('user', 'roles'));
    }
        
}