<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ThoiKhoaBieu\ThoiKhoaBieuRequest;
use App\Http\Requests\ThoiKhoaBieu\UpdateLichHocRequest;
use Carbon\Carbon;

//Model
use Illuminate\Support\Facades\Auth;
use App\Models\Lop;
use App\Models\DanhSachHocPhan;
use App\Models\Phong;
use App\Models\LopHocPhan;
use App\Models\User;
use App\Models\SinhVien;
use App\Models\NienKhoa;
use App\Models\NganhHoc;
use App\Models\MonHoc;
use App\Models\Nam;
use App\Models\Tuan;
use App\Models\HocKy;
use App\Models\ThoiKhoaBieu;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;

class LichHocController extends Controller
{
   public function store()
   {
      
   }

}