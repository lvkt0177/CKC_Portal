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
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id_sv = Auth::guard('student')->user()->id;

        $sinhVien = SinhVien::with('hoSo', 'lop', 'lopChuyenNganh')->findOrFail($id_sv);
        $lop = $sinhVien->lop;
        $nienkhoa = NienKhoa::findOrFail($lop->id_nien_khoa);
    
        $chuong_trinh_dao_tao = ChuongTrinhDaoTao::whereHas('chuyenNganh', function ($q) use ($lop) {
            $q->where('id_nganh_hoc', $lop->id_nganh_hoc);
        })->orderBy('id', 'asc')->first();
    
        if (!$chuong_trinh_dao_tao) {
            return redirect()->back()->with('error', 'Không có chương trình đào tạo nào.');
        }
    
        $ct_ctdt = ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao', 'hocKy'])
            ->where('id_chuong_trinh_dao_tao', $chuong_trinh_dao_tao->id)
            ->whereHas('hocKy', function ($q) use ($nienkhoa) {
                $q->where('id_nien_khoa', $nienkhoa->id);
            })
            ->get()
            ->groupBy('id_hoc_ky');
    
        $tenMons = $ct_ctdt->flatten()->pluck('monHoc.ten_mon')->filter()->unique();
    
        $diemHocPhan = DB::table('danh_sach_hoc_phan as dshp')
            ->join('lop_hoc_phan as lhp', 'lhp.id', '=', 'dshp.id_lop_hoc_phan')
            ->where('dshp.id_sinh_vien', $id_sv)
            ->whereIn('lhp.ten_hoc_phan', $tenMons)
            ->select(
                'lhp.ten_hoc_phan',
                'dshp.diem_chuyen_can',
                'dshp.diem_qua_trinh',
                'dshp.diem_thi',
                'dshp.diem_tong_ket'
            )
            ->get()
            ->keyBy('ten_hoc_phan');
    
        $gradesData = $ct_ctdt->mapWithKeys(function ($dsMon, $idHocKy) use ($diemHocPhan) {
            return [
                $idHocKy => $dsMon->map(function ($ct) use ($diemHocPhan) {
                    $tenMon = $ct->monHoc->ten_mon ?? '';
                    $diem = $diemHocPhan[$tenMon] ?? null;
    
                    return [
                        'ten_hoc_ky' => $ct->hocKy->ten_hoc_ky ?? '',
                        'ten_mon' => $tenMon,
                        'tin_chi' => $ct->so_tin_chi,
                        'chuyencan' => $diem->diem_chuyen_can ?? '-',
                        'quatrinh'  => $diem->diem_qua_trinh ?? '-',
                        'thi'       => $diem->diem_thi ?? '-',
                        'tongket'   => $diem->diem_tong_ket ?? '-',
                    ];
                })
            ];
        });

        $dsHocKy = HocKy::where('id_nien_khoa', $nienkhoa->id)->get();
        
       
        $idHocKy = $request->input('id_hoc_ky');

        if ($idHocKy) {
            $today = Carbon::today();

            $hocKyHienTai = HocKy::where('id_nien_khoa', $nienkhoa->id)
                ->where('ngay_bat_dau', '<=', $today)
                ->where('ngay_ket_thuc', '>=', $today)
                ->first();

            if ($hocKyHienTai) {
                $idHocKy = $hocKyHienTai->id;
            } else {
                // Nếu không có kỳ hiện tại, lấy kỳ gần nhất trong niên khóa đó
                $hocKyGanNhat = HocKy::where('id_nien_khoa', $nienkhoa->id)
                    ->where('ngay_ket_thuc', '<', $today)
                    ->orderByDesc('ngay_ket_thuc')
                    ->first();

                if ($hocKyGanNhat) {
                    $idHocKy = $hocKyGanNhat->id;
                }
            }
        }


        
        if ($idHocKy && $gradesData->has($idHocKy)) {
            $gradesData = $gradesData->only([$idHocKy]);
        }
        

        return view('client.home.index', compact('gradesData', 'dsHocKy', 'idHocKy'));
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