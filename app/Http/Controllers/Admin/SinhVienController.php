<?php

namespace App\Http\Controllers\SinhVien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SinhVienController extends Controller
{
    public function index(Request $request)
    {
    $id_lop = $request->input('id_lop');
    $query = DB::table('sinhvien as sv')
        ->join('ho_so as hs', 'sv.id_ho_so', '=', 'hs.id')
        ->join('lop as l', 'sv.id_lop', '=', 'l.id')
        ->join('nien_khoa as nk', 'sv.id_nien_khoa', '=', 'nk.id')
        ->select(
            'sv.id',
            'sv.ma_sv',
            'hs.ho_ten',
            'hs.email',
            'hs.so_dien_thoai',
            'l.ten_lop',
            'nk.ten_nien_khoa',
            'sv.id_lop'
        );
        if ($id_lop) {
        $query->where('sv.id_lop', $id_lop);
    }
    $sinhviens = $query->get();
    $lops = DB::table('lop')->get();
   return view('admin.student.index', compact('sinhviens', 'lops', 'id_lop'));

    }

}
