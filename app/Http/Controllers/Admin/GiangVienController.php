<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ThoiKhoaBieu;
use App\Models\LopHocPhan;
use App\Models\DanhSachHocPhan;
use App\Models\Phong;
use App\Models\Tuan;
use App\Models\Nam;
use App\Models\User;
use App\Models\HoSo;
use App\Models\BoMon;
use App\Models\Khoa;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use App\Acl\Acl;

class GiangVienController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:' . Acl::PERMISSION_TEACHER_LIST, ['only' => ['index', 'show']]);
        $this->middleware('permission:' . Acl::PERMISSION_TEACHER_SHOW_SCHEDULE, ['only' => ['xemLichDay']]);
    }
    public function index()
    {
        $users = User::with('hoSo', 'boMon', 'boMon.chuyenNganh.khoa')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.teacher.index', compact('users'));
    }

    //show
    public function show($id)
    {
        $data = User::with('hoSo', 'boMon', 'boMon.chuyenNganh.khoa')
            ->where('id', $id)
            ->orderBy('id', 'desc')
            ->get();

        if ($data->isEmpty()) {
            return redirect()->route('giangvien.giangvien.index')->with('error', 'Giảng viên không tồn tại.');
        }

        $user = $data[0];
        $roles = Role::all();

        return view('admin.teacher.show', compact('user', 'roles'));
    }
    public function xemLichDay(Request $request)
    {
        $today = now();

        $dsNam = Nam::all();

        
        $namDangChon = Nam::where('id', $request->nam)->first();
        if (!$namDangChon) {
            
            $namHocHienTai = $today->month >= 9 ? $today->year : $today->year - 1;

            $namDangChon = Nam::where('nam_bat_dau', $namHocHienTai)->first();

            
            if (!$namDangChon) {
                $namDangChon = Nam::orderByDesc('nam_bat_dau')->first();
            }
        }

        $dsTuan = Tuan::where('id_nam', $namDangChon->id)->get();

       
        $tuanDangChon = Tuan::where('id_nam', $namDangChon->id)
                            ->where('tuan', $request->id_tuan)  
                            ->first();

        if (!$tuanDangChon) {
            $tuanDangChon = Tuan::where('id_nam', $namDangChon->id)
                                ->whereDate('ngay_bat_dau', '<=', $today)
                                ->whereDate('ngay_ket_thuc', '>=', $today)
                                ->first();

           
            if (!$tuanDangChon) {
                $tuanDangChon = Tuan::where('id_nam', $namDangChon->id)
                                    ->orderBy('tuan')
                                    ->first();
            }
        }
        
        $ngayTrongTuan = collect();
        
        $bat_dau = \Carbon\Carbon::parse($tuanDangChon->ngay_bat_dau);
        $ket_thuc = \Carbon\Carbon::parse($tuanDangChon->ngay_ket_thuc);
        
        while ($bat_dau->lte($ket_thuc)) {
            $ngayTrongTuan->push($bat_dau->copy());
            $bat_dau->addDay();
        }
        $id_gv = Auth::user()->id;
        $thoikhoabieu = ThoiKhoaBieu::with([
        'lopHocPhan.lop',
        'lopHocPhan.giangVien.hoSo',
        'phong',
        'tuan'
        ])
        ->whereHas('lopHocPhan', function ($query) use ($id_gv) {
            $query->where('id_giang_vien', $id_gv);
        })
        ->where('id_tuan', $tuanDangChon->id)
        ->get();
       
        return view('admin.teacher.lichday',compact('ngayTrongTuan','dsTuan','tuanDangChon','dsNam','namDangChon','thoikhoabieu'));
    }
}