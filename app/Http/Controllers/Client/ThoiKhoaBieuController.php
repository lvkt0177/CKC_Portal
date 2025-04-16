<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ThoiKhoaBieu;
use App\Models\LopHocPhan;
use App\Models\DanhSachHocPhan;
use App\Models\Phong;
use App\Models\Tuan;
use App\Models\Nam;
use Illuminate\Support\Facades\Auth;

class ThoiKhoaBieuController extends Controller
{
    //
    public function index(Request $request)
    {
        $today = now();
       
        $dsNam = Nam::all();

        
        $namDangChon = Nam::where('id', $request->nam)->first();
        if (!$namDangChon) {
            
            $namHocHienTai = $today->month >= 9 ? $today->year : $today->year - 1;

            $namDangChon = Nam::where('nam_bat_dau', $namHocHienTai)->first();

            
            if (!$namDangChon) {
                $namDangChon = Nam::orderByDesc('nam_bat_dau')->first();
            }
        }

        $dsTuan = Tuan::where('id_nam', $namDangChon->id)->get();

       
        $tuanDangChon = Tuan::where('id_nam', $namDangChon->id)
                            ->where('tuan', $request->id_tuan)  
                            ->first();

        if (!$tuanDangChon) {
            $tuanDangChon = Tuan::where('id_nam', $namDangChon->id)
                                ->whereDate('ngay_bat_dau', '<=', $today)
                                ->whereDate('ngay_ket_thuc', '>=', $today)
                                ->first();

           
            if (!$tuanDangChon) {
                $tuanDangChon = Tuan::where('id_nam', $namDangChon->id)
                                    ->orderBy('tuan')
                                    ->first();
            }
        }
        $ngayTrongTuan = collect();
        $bat_dau = \Carbon\Carbon::parse($tuanDangChon->ngay_bat_dau);
        $ket_thuc = \Carbon\Carbon::parse($tuanDangChon->ngay_ket_thuc);
        while ($bat_dau->lte($ket_thuc)) {
            $ngayTrongTuan->push($bat_dau->copy());
            $bat_dau->addDay();
        }
       
       
        
        $id_sv = Auth::user()->id;
       
        $thoikhoabieu=ThoiKhoaBieu::with(['lopHocPhan.lop', 'lopHocPhan.giangVien.hoSo', 'phong', 'tuan'])
        ->whereHas('lopHocPhan.danhSachHocPhan', function ($query) use ($id_sv) {
            $query->where('id_sinh_vien', $id_sv);
        })
        
        ->where('id_tuan',$tuanDangChon->id)->get();
        


        return view('client.thoikhoabieu.index',compact('ngayTrongTuan','tuanDangChon','dsTuan','dsNam','namDangChon','thoikhoabieu'));
    }
}