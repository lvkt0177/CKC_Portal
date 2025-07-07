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

        $allFailed = DB::table('danh_sach_hoc_phan as dshp')
            ->join('lop_hoc_phan as lhp', 'lhp.id', '=', 'dshp.id_lop_hoc_phan')
            ->join('lop as lp', 'lp.id', '=', 'lhp.id_lop')
            ->join('mon_hoc as mh', 'mh.ten_mon', '=', 'lhp.ten_hoc_phan')
            ->join('chi_tiet_ctdt as ct', 'ct.id_mon_hoc', '=', 'mh.id')
            ->where('lhp.trang_thai_nop_bang_diem', '>=', 3)
            ->where('dshp.id_sinh_vien', $idSinhVien)
            ->where('dshp.diem_tong_ket', '<', 5)
            ->select(
                'lp.ten_lop',
                'dshp.id_lop_hoc_phan',
                'lhp.loai_mon',
                'lhp.ten_hoc_phan',
                'mh.ten_mon',
                'mh.id as id_mon_hoc',
                'dshp.diem_tong_ket',
                'ct.so_tin_chi'
            )
            ->orderByDesc('dshp.id_lop_hoc_phan')
            ->get();

        $monHoc = $allFailed->unique('id_mon_hoc')->values();

        $monHoc = $monHoc->map(function ($item) {
            $item->loai_mon_enum = LoaiMonHoc::from($item->loai_mon);
            $item->loai_mon = $item->loai_mon_enum->getLabel();
            return $item;
        });

        return view('client.dangkyhocghep.index', compact('monHoc'));
    }

    public function list($id_mon_hoc)
    {
        $monHoc = MonHoc::find($id_mon_hoc);

        $lopHocPhanDangMo = LopHocPhan::with('lop','giangVien.hoSo','thoiKhoaBieu.phong')->where('trang_thai', 1)
            ->where('ten_hoc_phan', 'LIKE', '%' . $monHoc->ten_mon . '%')
            ->get();

        $dsThoiKhoaBieuDauTien = $lopHocPhanDangMo->map(function ($lop) {
            return $lop->thoiKhoaBieu->sortBy(fn($tkb) => $tkb->ngay)->first();
        })->filter();

        $checkDKHG = DangKyHGTL::whereIn('id_lop_hoc_phan', $lopHocPhanDangMo->pluck('id'))
            ->where('id_sinh_vien', Auth::guard('student')->id())
            ->where('trang_thai', 1)
            ->where('loai_dong', 0)
            ->exists();

        return view('client.dangkyhocghep.list', compact('lopHocPhanDangMo', 'monHoc', 'checkDKHG', 'dsThoiKhoaBieuDauTien'));
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
