<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
//Model
use App\Models\DanhSachHocPhan;
use App\Models\SinhVien;
use App\Models\NienKhoa;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\MonHoc;
use App\Models\ChuongTrinhDaoTao;
use App\Models\LopHocPhan;
use App\Models\Lop;
class KDTController extends Controller
{
    public function index(Request $request)
    {
        $sinhvien = Auth::guard('student')->user()->load('lop');

        $lop = Lop::where('id', Auth::user()->id_lop)->first();

        $nienkhoa = NienKhoa::where('id', $lop->id_nien_khoa)->first();

        
        $chuong_trinh_dao_tao = ChuongTrinhDaoTao::whereHas('chuyenNganh', function ($q) use ($sinhvien) {
            $q->where('id_chuyen_nganh', $sinhvien->lop->id_chuyen_nganh);
        })->orderBy('id', 'asc')->get();
       

        $id_chuong_trinh_dao_tao = $request->input("id_chuong_trinh_dao_tao") ?? ($chuong_trinh_dao_tao->first()->id ?? null);

        if (!$id_chuong_trinh_dao_tao) {
            return redirect()->back()->with('error', 'Không có chương trình đào tạo nào.');
        }


        $ct_ctdt = collect();
        if ($id_chuong_trinh_dao_tao && $nienkhoa) {
            $ct_ctdt = ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao', 'hocKy'])
                ->where('id_chuong_trinh_dao_tao', $id_chuong_trinh_dao_tao)
                ->whereHas('hocKy', function ($q) use ($nienkhoa) {
                    $q->where('id_nien_khoa', $nienkhoa->id);
                })
                ->get()
                ->groupBy('id_hoc_ky');
        }

        return view('client.khungdaotao.index', compact( 'ct_ctdt', 'id_chuong_trinh_dao_tao', 'chuong_trinh_dao_tao'));
    }
}