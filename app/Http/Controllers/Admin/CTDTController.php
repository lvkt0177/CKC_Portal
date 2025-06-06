<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DanhSachHocPhan;
use Illuminate\Http\Request;

//Model
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\MonHoc;
use App\Models\ChuongTrinhDaoTao;
use App\Models\LopHocPhan;
use App\Models\Lop;

class CTDTController extends Controller
{
    public function index(Request $request)
    {

        $ctdt = ChuongTrinhDaoTao::orderBy('id', 'desc')->get();

        $id_chuong_trinh_dao_tao = $request->input("id_chuong_trinh_dao_tao") ?? $ctdt->first()->id;

        $ct_ctdt = ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao'])
            ->where('id_chuong_trinh_dao_tao', $id_chuong_trinh_dao_tao)
            ->get()
            ->groupBy('id_hoc_ky');

        $lop_hoc_phan = LopHocPhan::with(['chuongTrinhDaoTao', 'lop', 'chuongTrinhDaoTao.chiTietChuongTrinhDaoTao'])
            ->where('id_chuong_trinh_dao_tao', $id_chuong_trinh_dao_tao)
            ->get();
        $danh_sach_HP = DanhSachHocPhan::with(['lopHocPhan', 'sinhVien', 'sinhVien.hoSo'])
            ->get();
        return view('admin.ctdt.index', compact('danh_sach_HP', 'ct_ctdt', 'id_chuong_trinh_dao_tao', 'ctdt', 'lop_hoc_phan'));

    }
}