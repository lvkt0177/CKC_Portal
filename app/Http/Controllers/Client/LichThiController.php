<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\LichThi;
use App\Models\Lop;
use App\Models\LopHocPhan;
use Illuminate\Support\Facades\Auth;

class LichThiController extends Controller
{
    //
    public function index(Request $request)
    {   
        $id_sinh_vien = Auth::guard('student')->user()->id;

        $lop = Lop::with('danhSachSinhVien')
            ->whereHas('danhSachSinhVien', function ($query) use ($id_sinh_vien) {
                $query->where('id_sinh_vien', $id_sinh_vien);
            })
            ->get();

        $lopIds = $lop->pluck('id'); 
        
        $dsTuan = LichThi::with(['lopHocPhan', 'giamThi1.hoSo', 'giamThi2.hoSo', 'phong'])
        ->whereHas('lopHocPhan', function ($query) use ($lopIds) {
            $query->whereIn('id_lop', $lopIds);
        })
        ->orderBy('ngay_thi', 'asc')
        ->get();


        $idTuan = $request->id_tuan; 
        if(!$idTuan){
            $idTuan = $dsTuan->first()->id_tuan;
        }
            
        $lichThi = LichThi::with(['lopHocPhan', 'giamThi1.hoSo', 'giamThi2.hoSo', 'phong'])
        ->where('id_tuan', $idTuan)
        ->whereHas('lopHocPhan', function ($query) use ($lopIds) {
            $query->whereIn('id_lop', $lopIds);
        })
        ->orderBy('ngay_thi', 'asc')
        ->get();
        
        $dsNgay = $lichThi->groupBy('ngay_thi');
       
        
        return view("client.lichthi.index",  compact('dsNgay', 'lichThi','lop','dsTuan'));
    }

    public function listLichThiLanHai()
    {
        $sinhVien = Auth::guard('student')->user();
        
        $lichThi = LichThi::with([
            'giamThi1.hoSo',
            'giamThi2.hoSo',
            'phong',
            'lopHocPhan.dangKyHocGhepThiLai',
            'lopHocPhan.danhSachHocPhan' => function ($query) use ($sinhVien) {
                $query->where('id_sinh_vien', $sinhVien->id);
            },
        ])
            ->whereHas('lopHocPhan.danhSachHocPhan', function ($query) use ($sinhVien) {
                $query->where('id_sinh_vien', $sinhVien->id);
            })
            ->where('lan_thi', 2)
            ->orderBy('ngay_thi')
            ->get();
        
        return view("client.lichthi.list", compact('lichThi'));
    }
}