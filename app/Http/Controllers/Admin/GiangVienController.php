<?php

namespace App\Http\Controllers\GiangVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiangVienController extends Controller
{
    public function show(Request $request)
    {
        $id_khoa = $request->input('id_khoa');

        $query = DB::table('users as u')
            ->where('u.loai_nguoi_dung', 1); // 1 = giảng viên

        if ($id_khoa) {
            $query->where('u.id_khoa', $id_khoa);
        }

        $giangviens = $query->get();
        $khoas = DB::table('khoa')->get();
        return view('admin.users.index', compact('giangviens', 'khoas', 'id_khoa'));

    }
}