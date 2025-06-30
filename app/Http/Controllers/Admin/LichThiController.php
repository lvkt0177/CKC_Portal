<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;


//Models
use Illuminate\Support\Facades\Auth;
use App\Models\Lop;
use App\Models\DanhSachHocPhan;
use App\Models\Phong;
use App\Models\LopHocPhan;
use App\Models\User;
use App\Models\SinhVien;
use App\Models\NienKhoa;
use App\Models\NganhHoc;
use App\Models\MonHoc;
use App\Models\Nam;
use App\Models\Tuan;
use App\Models\HocKy;
use App\Models\ThoiKhoaBieu;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;


class LichThiController extends Controller
{
    //
    public function index(Request $request)
    {
        $nienKhoas = NienKhoa::orderBy('id', 'desc')->get();
        $nganhHocs = NganhHoc::orderBy('id', 'desc')->get();

        $id_nien_khoa = $request->input('id_nien_khoa') ?? NienKhoa::where('nam_bat_dau', '<', Carbon::now()->year)
            ->where('nam_ket_thuc', '>=', Carbon::now()->year)
            ->orderByDesc('nam_ket_thuc')
            ->first()?->id;
        $id_nganh_hoc = $request->input('id_nganh_hoc');
        
        $lops = Lop::with([
           'giangVien','giangVien.hoSo'
        ])->where('id_nien_khoa', $id_nien_khoa)
            ->when($id_nganh_hoc, function ($query) use ($id_nganh_hoc) {
                return $query->whereHas('giangVien.boMon.nganhHoc', function ($q) use ($id_nganh_hoc) {
                    $q->where('id', $id_nganh_hoc);
                });
            })
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.lichthi.index', compact('lops', 'nienKhoas', 'id_nien_khoa', 'id_nganh_hoc', 'nganhHocs'));
    }
    public function show(Request $request,Lop $lop)
    {
        $today = now();

        
        $dsHocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
                        ->orderBy('ngay_bat_dau')
                        ->get();


        $hocKy = null;

        if ($request->filled('hoc_ky')) {
            $hocKy = HocKy::find($request->hoc_ky);
        }

        if (!$hocKy) {
            $hocKy = HocKy::where('ngay_bat_dau', '<=', $today)
                        ->where('ngay_ket_thuc', '>=', $today)
                        ->first();
        }

        if (!$hocKy) {
            $hocKy = HocKy::where('ngay_ket_thuc', '<=', $today)
                        ->orderByDesc('ngay_ket_thuc')
                        ->first();
        }


        $dsTuan = Tuan::whereDate('ngay_bat_dau', '>=', $hocKy->ngay_bat_dau)
                    ->whereDate('ngay_ket_thuc', '<=', $hocKy->ngay_ket_thuc)
                    ->orderBy('tuan')
                    ->get();


        $tuanDangChon = $request->filled('id_tuan')
            ? Tuan::find($request->id_tuan)
            : $dsTuan->first();

        $tuan = $tuanDangChon;

        $ngayTrongTuan = collect();
        if ($tuan) {
            $bat_dau = \Carbon\Carbon::parse($tuan->ngay_bat_dau);
            $ket_thuc = \Carbon\Carbon::parse($tuan->ngay_ket_thuc);
            while ($bat_dau->lte($ket_thuc)) {
                $ngayTrongTuan->push($bat_dau->copy());
                $bat_dau->addDay();
            }
        }

        //$lichthi = LichThi
        return view('admin.lichthi.show', compact('ngayTrongTuan','lop','dsHocKy','dsTuan','hocKy','tuanDangChon'));
    }
    public function create(Request $request,Lop $lop)
    {
        
        $today = now();
        $dsHocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
                        ->where('ngay_bat_dau', '>=', $today)
                        ->orderBy('ngay_bat_dau')
                        ->get();

        if ($request->filled('hoc_ky')) {
            $hocKy = HocKy::find($request->hoc_ky);
        } else {
            $hocKy = $dsHocKy->first();
        }
        
        $dsLopHP = collect();
        $dsLopHP = LopHocPhan::where('id_lop', $lop->id)
                ->whereHas('chuongTrinhDaoTao.chiTietChuongTrinhDaoTao', function ($query) use ($hocKy) {
                    $query->where('id_hoc_ky', $hocKy->id);})
                ->get();
        dump($dsLopHP);           
        $dsTuan = Tuan::whereDate('ngay_bat_dau', '>=', $hocKy->ngay_bat_dau)
                    ->whereDate('ngay_ket_thuc', '<=', $hocKy->ngay_ket_thuc)
                    ->orderBy('tuan')
                    ->get();
        

        if ($request->filled('tuan')) {
            $tuanDangChon = $dsTuan->firstWhere('id', $request->tuan);
        } else {
            $tuanDangChon = $dsTuan->slice(16)->first();
        }
        
        $ngayTrongTuan = collect();
        if ($tuanDangChon) {
            $bat_dau = \Carbon\Carbon::parse($tuanDangChon->ngay_bat_dau);
            $ket_thuc = \Carbon\Carbon::parse($tuanDangChon->ngay_ket_thuc);
            while ($bat_dau->lte($ket_thuc)) {
                $ngayTrongTuan->push($bat_dau->copy());
                $bat_dau->addDay();
            }
        }
        
        $giam_thi = User::with('boMon.nganhHoc')
        ->whereHas('boMon.nganhHoc', function ($query) use ($lop) {
            $query->where('id_nganh_hoc', $lop->id_nganh_hoc);
        })
        ->get(); 

        $phong = Phong::all();
        return view('admin.lichthi.create', compact(
            'lop',
            'phong',
            'giam_thi',
            'dsHocKy',
            'hocKy',
            'dsLopHP',
            'dsTuan',
            'tuanDangChon',
            'ngayTrongTuan'
            
        
        ));
    }
    public function store()
    {
        return redirect()->route('giangvien.lichthi.create',['lop'=>$lop])
        ->with('success', 'Thêm thành công');
    }
    
}