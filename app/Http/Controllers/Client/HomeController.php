<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\SinhVien;
use App\Models\HocKy;
use App\Models\Lop;
use App\Models\Nam;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\NienKhoa;
use App\Models\DiemRenLuyen;
use App\Models\LopHocPhan;
use Illuminate\Support\Facades\DB;
use App\Services\LopHocPhanService;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected LopHocPhanService $lopHocPhanService
    ) {
        //
    }
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek(); 

        $lopHocPhan = $this->lopHocPhanService->dongCacLopHetHanDangKy();
        $sinhVien = Auth::guard('student')->user();
        $sinhVien->load('danhSachSinhVien.lop');

        $lichHocTrongTuan = LopHocPhan::with(['thoiKhoaBieu' => function ($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('ngay', [$startOfWeek->toDateString(), $endOfWeek->toDateString()]);
        }])
        ->where('id_lop', $sinhVien->danhSachSinhVien->last()->id_lop)
        ->get();

        $tongSoLichHoc = $lichHocTrongTuan->sum(function ($lopHocPhan) {
            return $lopHocPhan->thoiKhoaBieu->count();
        });

        $lichThiTrongTuan = LopHocPhan::with(['lichThi' => function ($query) use ($startOfWeek, $endOfWeek) {
            $query->whereBetween('ngay_thi', [$startOfWeek->toDateString(), $endOfWeek->toDateString()]);
        }])
        ->where('id_lop', $sinhVien->danhSachSinhVien->last()->id_lop)
        ->get();
        
        $tongSoLichThi = $lichThiTrongTuan->sum(function ($lopHocPhan) {
            return $lopHocPhan->lichThi->count();
        });
        
        return view('client.home.index', compact('sinhVien', 'tongSoLichHoc', 'tongSoLichThi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}