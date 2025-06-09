<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhieuLenLop;


class PhieuLenLopController extends Controller
{
    //
    public function index(){
        
        
        $phieu_len_lop = PhieuLenLop::with('lopHocPhan','lopHocPhan.lop','lopHocPhan.giangVien.hoSo', 'phong','tuan')->get();
        $ngayTrongTuan = [];

    foreach ($phieu_len_lop as $pll) {
        $bat_dau = \Carbon\Carbon::parse($pll->tuan->ngay_bat_dau);
        $ket_thuc = \Carbon\Carbon::parse($pll->tuan->ngay_ket_thuc);

        while ($bat_dau->lte($ket_thuc)) {
            $ngayTrongTuan[] = $bat_dau->copy(); // lưu bản sao
            $bat_dau->addDay();
        }
    }

    // Loại bỏ trùng lặp ngày nếu có
    $ngayTrongTuan = collect($ngayTrongTuan)->unique(function ($date) {
        return $date->format('Y-m-d');
    })->sort();
        return view('admin.phieulenlop.index',compact('phieu_len_lop','ngayTrongTuan'));
    }

}