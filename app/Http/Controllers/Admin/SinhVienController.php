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
    public function index()
    {
        $sinhviens = SinhVien::with(['hoSo', 'lop', 'lop.nienKhoa'])
            ->orderBy('id', 'desc')
            ->get();

        // dd($sinhviens);

        return view('admin.student.index', compact('sinhviens'));

    }

}