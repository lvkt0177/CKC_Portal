<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
//Model
use App\Models\DanhSachHocPhan;
use App\Models\SinhVien;
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

        $chuong_trinh_dao_tao = ChuongTrinhDaoTao::whereHas('chuyenNganh', function ($q) use ($sinhvien) {
            $q->where('id_nganh_hoc', $sinhvien->lop->id_nganh_hoc);
        })->orderBy('id', 'asc')->get();
       

        $id_chuong_trinh_dao_tao = $request->input("id_chuong_trinh_dao_tao") ?? ($chuong_trinh_dao_tao->first()->id ?? null);

        if (!$id_chuong_trinh_dao_tao) {
            return redirect()->back()->with('error', 'Không có chương trình đào tạo nào.');
        }


        $ct_ctdt = ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao'])
            ->where('id_chuong_trinh_dao_tao', $id_chuong_trinh_dao_tao)
            ->get()
            ->groupBy('id_hoc_ky');

        $lop_hoc_phan = LopHocPhan::with(['chuongTrinhDaoTao', 'lop', 'chuongTrinhDaoTao.chiTietChuongTrinhDaoTao'])
            ->where('id_chuong_trinh_dao_tao', $id_chuong_trinh_dao_tao)
            ->get();
        $danh_sach_HP = DanhSachHocPhan::with(['lopHocPhan', 'sinhVien', 'sinhVien.hoSo'])
            ->get();
        return view('client.khungdaotao.index', compact('danh_sach_HP', 'ct_ctdt', 'id_chuong_trinh_dao_tao', 'chuong_trinh_dao_tao', 'lop_hoc_phan'));
    }
}