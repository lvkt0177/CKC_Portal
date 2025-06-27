<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
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
    public function index()
    {
        $chuong_trinh_dao_tao = ChuongTrinhDaoTao::with('chiTietChuongTrinhDaoTao.monHoc')->get();
           
        return response()->json([
            'status' => 'success',
            'chuong_trinh_dao_tao' => $chuong_trinh_dao_tao
        ]);
    }
}