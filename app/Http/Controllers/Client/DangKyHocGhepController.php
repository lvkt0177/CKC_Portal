<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\SinhVien;
use App\Models\Lop;
use App\Models\ChuongTrinhDaoTao;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\NienKhoa;
use App\Models\HocKy;
use App\Models\MonHoc;
use App\Models\DanhSachHocPhan;
use Illuminate\Support\Facades\DB;
use App\Enum\LoaiMonHoc;
use Carbon\Carbon;
use App\Models\LopHocPhan;
use App\Models\ChuyenNganh;
use App\Models\DangKyHGTL;
use App\Models\DangKyHocGhepTL;

class DangKyHocGhepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idSinhVien = Auth::guard('student')->id();
        
        $monHoc = DB::table('danh_sach_hoc_phan as dshp')
            ->join('lop_hoc_phan as lhp', 'lhp.id', '=', 'dshp.id_lop_hoc_phan')
            ->join('mon_hoc as mh', 'mh.ten_mon', '=', 'lhp.ten_hoc_phan')
            ->join('chi_tiet_ctdt as ct', 'ct.id_mon_hoc', '=', 'mh.id')
            ->where('lhp.trang_thai_nop_bang_diem', '>=', 2)
            ->where('dshp.id_sinh_vien', $idSinhVien)
            ->where('dshp.diem_tong_ket', '<', 5)
            ->select(
                'lhp.loai_mon',
                'lhp.ten_hoc_phan as ten_hoc_phan',
                'mh.ten_mon',
                'mh.id as id_mon_hoc',
                'dshp.diem_tong_ket',
                'ct.so_tin_chi',
            )
            ->distinct()
            ->get()
            ->map(function ($item) {
                $item->loai_mon_enum = LoaiMonHoc::from($item->loai_mon);
                $item->loai_mon = $item->loai_mon_enum->getLabel();
                return $item;
            });

        return view('client.dangkyhocghep.index', compact('monHoc'));
    }

    public function list($id_mon_hoc)
    {
        $monHoc = MonHoc::find($id_mon_hoc);

        $lopHocPhanDangMo = LopHocPhan::where('trang_thai', 1)
            ->where('ten_hoc_phan', 'LIKE', '%' . $monHoc->ten_mon . '%')
            ->get();

        $lopHocPhanDangMo->load('lop','giangVien.hoSo','thoiKhoaBieu.phong');

        $checkDKHG = DangKyHGTL::whereIn('id_lop_hoc_phan', $lopHocPhanDangMo->pluck('id'))
            ->where('id_sinh_vien', Auth::guard('student')->id())
            ->where('trang_thai', 1)
            ->exists();

        
        return view('client.dangkyhocghep.list', compact('lopHocPhanDangMo', 'monHoc', 'checkDKHG'));
    }

    public function history()
    {
        $sinhVien = Auth::guard('student')->user();

        $dangKyHocGhep = DangKyHGTL::where('id_sinh_vien', $sinhVien->id)
            ->where('trang_thai', '!=', 0)
            ->where('loai_dong', 0)
            ->with(['lopHocPhan.lop', 'lopHocPhan.giangVien.hoSo'])
            ->get();

        return view('client.dangkyhocghep.history', compact('dangKyHocGhep', 'sinhVien'));
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
