<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\HoSo;
use App\Models\BoMon;
use App\Models\NganhHoc;
use App\Models\Khoa;
use \Spatie\Permission\Models\Role;

class GiangVienController extends Controller
{
    //api/admin/giangvien
    public function index()
    {
        $users = User::with('hoSo', 'boMon', 'boMon.nganhHoc.khoa')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($users);
    }

    //api/admin/giangvien/{id}
    public function show(int $id)
    {
        $data = User::with('hoSo','boMon.nganhHoc.khoa')
        ->where('id', $id)
        ->orderBy('id', 'desc')
        ->get();

        if ($data->isEmpty()) {
            return redirect()->route('admin.giangvien.index')->with('error', 'Giảng viên không tồn tại.');
        }

        $user = $data[0];
        $roles = Role::all();

        return response()->json([
            'success' => true,
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }
            
}