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

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id_sv = Auth::guard('student')->id();

        $sinhVien = SinhVien::with(['hoSo', 'lop'])->findOrFail($id_sv);
        $lop = $sinhVien->lop;
        $nienkhoa = $lop->nienKhoa ?? null;

        // Lấy chương trình đào tạo
        $chuong_trinh_dao_tao = ChuongTrinhDaoTao::whereHas('chuyenNganh', function ($q) use ($sinhVien) {
            $q->where('id_nganh_hoc', $sinhVien->lop->id_nganh_hoc);
        })->orderBy('id', 'asc')->get();

        if ($chuong_trinh_dao_tao->isEmpty()) {
            return redirect()->back()->with('error', 'Không có chương trình đào tạo nào.');
        }

        $id_chuong_trinh_dao_tao = $chuong_trinh_dao_tao->first()->id;

        // Lấy chi tiết CTĐT theo niên khóa
        $ct_ctdt = ChiTietChuongTrinhDaoTao::with(['monHoc', 'hocKy'])
            ->where('id_chuong_trinh_dao_tao', $id_chuong_trinh_dao_tao)
            ->when($nienkhoa, function ($q) use ($nienkhoa) {
                $q->whereHas('hocKy', function ($query) use ($nienkhoa) {
                    $query->where('id_nien_khoa', $nienkhoa->id);
                });
            })
            ->get()
            ->groupBy('id_hoc_ky');

        // Dữ liệu điểm
        $gradesData = $ct_ctdt->mapWithKeys(function ($dsMon, $idHocKy) {
            return [
                $idHocKy => $dsMon->map(function ($ct) {
                    return [
                        'ten_mon'    => $ct->monHoc->ten_mon ?? '',
                        'tin_chi'    => $ct->so_tin_chi,
                        'chuyencan'  => $ct->diem_chuyen_can ?? '-',
                        'quatrinh'   => $ct->diem_qua_trinh ?? '-',
                        'thi'        => $ct->diem_thi ?? '-',
                        'tongket'    => $ct->diem_tong_ket ?? '-',
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