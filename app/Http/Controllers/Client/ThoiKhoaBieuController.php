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
        $namDangChon = $request->nam ?? $today->year;

        $nam = Nam::where('nam_bat_dau', $namDangChon)->first();
        if (!$nam) {
            $nam = Nam::where('nam_bat_dau', $today->year)->first();
        }

        $tuanDangChon = $request->id_tuan;
        $tuan = Tuan::where('id_nam', $nam->id)
                    ->where('tuan', $tuanDangChon)
                    ->first();

        if (!$tuan) {
            $tuan = Tuan::where('id_nam', $nam->id)
                        ->whereDate('ngay_bat_dau', '<=', $today)
                        ->whereDate('ngay_ket_thuc', '>=', $today)
                        ->first();
        }
        $ngayTrongTuan = collect();
        $bat_dau = \Carbon\Carbon::parse($tuan->ngay_bat_dau);
        $ket_thuc = \Carbon\Carbon::parse($tuan->ngay_ket_thuc);
        while ($bat_dau->lte($ket_thuc)) {
            $ngayTrongTuan->push($bat_dau->copy());
            $bat_dau->addDay();
        }
       
       
        
        $id_sv = Auth::user()->id;
       
        $thoikhoabieu=ThoiKhoaBieu::with(['lopHocPhan', 'lopHocPhan.lop', 'lopHocPhan.giangVien.hoSo', 'phong', 'tuan'])
        ->whereHas('lopHocPhan.danhSachHocPhan', function ($query) use ($id_sv) {
            $query->where('id_sinh_vien', $id_sv);
        })
        ->where('id_tuan',$tuan->id)->get();
       


        return view('client.thoikhoabieu.index',compact('ngayTrongTuan','tuan','thoikhoabieu'));
    }
}