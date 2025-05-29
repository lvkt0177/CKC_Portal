<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\HoSo;
use App\Models\Lop;
use App\Models\NienKhoa;


class SinhVienController extends Controller
{
    public function index(Request $request)
    {
        $id_lop = $request->input('id_lop');

        $lops = Lop::orderBy('id', 'desc')->get();

        $sinhviens = SinhVien::with(['hoSo', 'lop', 'lop.nienKhoa'])
            ->when($id_lop, function ($query) use ($id_lop) {
                $query->where('id_lop', $id_lop);
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.student.index', compact('lops', 'sinhviens', 'id_lop'));

    }

}