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
        $sinhvien = Auth::guard('student')->user()->load('danhSachSinhVien');
        
        $lopCuaSinhVien = $sinhvien->danhSachSinhVien;
        
        $lop = Lop::where('id', $lopCuaSinhVien[0]->id_lop)->first();

        $lopchuyenNganh = $lopCuaSinhVien->count()>1 ? Lop::where('id', $lopCuaSinhVien[1]->id_lop)->first() : null;
        
        $nienkhoa = NienKhoa::where('id', $lop->id_nien_khoa)->first();

        $chuong_trinh_dao_tao_md = ChuongTrinhDaoTao::whereHas('chuyenNganh', function ($q) use ($lop) {
            $q->where('id_chuyen_nganh', $lop->id_chuyen_nganh);
        })->orderBy('id', 'asc')->first();
        
        $chuong_trinh_dao_tao_cn = $lopCuaSinhVien->count()>1 ? ChuongTrinhDaoTao::whereHas('chuyenNganh', function ($q) use ($lopchuyenNganh) {
            $q->where('id_chuyen_nganh', $lopchuyenNganh->id_chuyen_nganh);
        })->orderBy('id', 'asc')->first():null;
        
        $ct_ctdt_md = collect();
        $ct_ctdt_cn = collect();
        $ct_ctdt_all = collect();
        
        $ct_ctdt_md = ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao', 'hocKy'])
            ->where('id_chuong_trinh_dao_tao', $chuong_trinh_dao_tao_md->id)
            ->whereHas('hocKy', function ($q) use ($nienkhoa) {
                $q->where('id_nien_khoa', $nienkhoa->id);
            })
            ->get();
        
        $ct_ctdt_cn = $lopCuaSinhVien->count()>1 ? ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao', 'hocKy'])
            ->where('id_chuong_trinh_dao_tao', $chuong_trinh_dao_tao_cn->id)
            ->whereHas('hocKy', function ($q) use ($nienkhoa) {
                $q->where('id_nien_khoa', $nienkhoa->id);
            })
            ->get()
            :collect();    
           
        $ct_ctdt_all = $ct_ctdt_md->merge($ct_ctdt_cn);
        $ct_ctdt_all = $ct_ctdt_all->flatten(1);
        $ct_ctdt_all = $ct_ctdt_all->groupBy('id_hoc_ky');
        
        return view('client.khungdaotao.index', compact( 'ct_ctdt_all'));
    }
}