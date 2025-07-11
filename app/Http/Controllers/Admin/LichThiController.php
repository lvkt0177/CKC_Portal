<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\LichThi\LichThiRequest;


//Models
use Illuminate\Support\Facades\Auth;
use App\Models\Lop;
use App\Models\DanhSachHocPhan;
use App\Models\Phong;
use App\Models\LopHocPhan;
use App\Models\User;
use App\Models\SinhVien;
use App\Models\NienKhoa;
use App\Models\ChuyenNganh;
use App\Models\MonHoc;
use App\Models\Nam;
use App\Models\Tuan;
use App\Models\HocKy;
use App\Models\ThoiKhoaBieu;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;
use App\Models\LichThi;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use App\Acl\Acl;
use App\Services\LichThiService;

class LichThiController extends Controller
{
    public function __construct() {
        $this->middleware('permission:' . Acl::PERMISSION_TIMETABLE_EXAM, ['only' => ['index']]);
        $this->middleware('permission:' . Acl::PERMISSION_TIMETABLE_EXAM_SHOW, ['only' => ['show','xemLichThi']]);
        $this->middleware('permission:' . Acl::PERMISSION_TIMETABLE_EXAM_CREATE, ['only' => ['create', 'store']]);
    }

    public function index(Request $request)
    {
        $nienKhoas = NienKhoa::orderBy('id', 'desc')->get();
        $nganhHocs = ChuyenNganh::select('ten_chuyen_nganh')
                ->distinct()
                ->get();


        $ten_chuyen_nganh = $request->input('ten_chuyen_nganh');
                
        $id_nien_khoa = $request->input('id_nien_khoa') ?? NienKhoa::where('nam_bat_dau', '<', Carbon::now()->year)
            ->where('nam_ket_thuc', '>=', Carbon::now()->year)
            ->orderByDesc('nam_ket_thuc')
            ->first()?->id;
        
        $lops = Lop::with(['nienKhoa', 'giangVien', 'chuyenNganh'])
            ->where('id_nien_khoa', $id_nien_khoa)
            ->when($ten_chuyen_nganh, function ($query) use ($ten_chuyen_nganh) {
                $query->whereHas('chuyenNganh', function ($q) use ($ten_chuyen_nganh) {
                    $q->where('ten_chuyen_nganh', $ten_chuyen_nganh);
                });
            })
            ->orderByDesc('id')
            ->get();
        return view('admin.lichthi.index', compact('lops', 'nienKhoas', 'id_nien_khoa', 'nganhHocs','ten_chuyen_nganh'));
    }
    public function show(Request $request,Lop $lop)
    {
        $today = now();
        $nienKhoa = $lop->nienKhoa;

        if ($nienKhoa && $nienKhoa->nam_ket_thuc <= now()->year) {
            return redirect()->route('giangvien.lichthi.index')
                ->with('error', 'Lớp đã hết kỳ để tạo thời khóa biểu');
        }
        $dsHocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
                        ->orderBy('ngay_bat_dau')
                        ->get();

        $hocKy = null;

        if ($request->filled('hoc_ky')) {
            $hocKy = HocKy::find($request->hoc_ky);
        }

        if (!$hocKy) {
            $hocKy = HocKy::where('ngay_bat_dau', '<=', $today)
                        ->where('ngay_ket_thuc', '>=', $today)
                        ->first();
        }

        if (!$hocKy) {
            $hocKy = HocKy::where('ngay_ket_thuc', '<=', $today)
                        ->orderByDesc('ngay_ket_thuc')
                        ->first();
        }


        $dsTuan = Tuan::whereDate('ngay_bat_dau', '>=', $hocKy->ngay_bat_dau)
                    ->whereDate('ngay_ket_thuc', '<=', $hocKy->ngay_ket_thuc)
                    ->orderBy('tuan')
                    ->get();


        $tuanDangChon = $request->filled('id_tuan')
            ? Tuan::find($request->id_tuan)
            : $dsTuan->first();

        $tuan = $tuanDangChon;
        
        $ngayTrongTuan = collect();
        if ($tuan) {
            $bat_dau = \Carbon\Carbon::parse($tuan->ngay_bat_dau);
            $ket_thuc = \Carbon\Carbon::parse($tuan->ngay_ket_thuc);
            while ($bat_dau->lte($ket_thuc)) {
                $ngayTrongTuan->push($bat_dau->copy());
                $bat_dau->addDay();
            }
        }

        
            $lichThi = LichThi::with(['lopHocPhan', 'giamThi1', 'giamThi2', 'phong'])
                ->whereHas('lopHocPhan', function ($query) use ($lop) {
                    $query->where('id_lop', $lop->id);
                })
            ->orderBy('ngay_thi', 'asc')
            ->get();
         
        return view('admin.lichthi.show', compact('ngayTrongTuan','lichThi','lop','dsHocKy','dsTuan','hocKy','tuanDangChon'));
    }

    public function xemLichThi(Request $request, Lop $lop)
    {
        $tuanDaCoLich = LichThi::whereHas('lopHocPhan', function ($query) use ($lop) {
                $query->where('id_lop', $lop->id);
            })
            ->select('id_tuan')
            ->distinct()
            ->with('tuan')
            ->get();
            
        $lanThiDaCoLich = LichThi::whereHas('lopHocPhan', function ($query) use ($lop) {
            $query->where('id_lop', $lop->id);
        })
        ->select('lan_thi') 
        ->distinct()
        ->orderBy('lan_thi')
        ->get();

        
        $lanthi = $request->lanthi;
        if(!$lanthi && $lanThiDaCoLich->isNotEmpty()){
            $lanthi = $lanThiDaCoLich->first()->lan_thi;  
        }
        $idTuan = $request->id_tuan;
    
        if (!$idTuan && $tuanDaCoLich->isNotEmpty()) {
            
            $idTuan = $tuanDaCoLich->first()->id_tuan;
        }
    
        $lichThi = LichThi::with(['lopHocPhan', 'giamThi1.hoSo', 'giamThi2.hoSo', 'phong'])
            ->where('id_tuan', $idTuan)
            ->where('lan_thi', $lanthi)
            ->whereHas('lopHocPhan', function ($query) use ($lop) {
                $query->where('id_lop', $lop->id);
            })
            ->orderBy('ngay_thi', 'asc')
            ->orderBy('gio_bat_dau', 'asc')
            ->get();
        
        $dsNgay = $lichThi->groupBy('ngay_thi');
    
        return view('admin.lichthi.show', compact(
            'dsNgay',
            'lichThi',
            'lop',
            'tuanDaCoLich',
            'idTuan',
            'lanthi',
            'lanThiDaCoLich'
        ));
    }
    
    public function create(Request $request,Lop $lop)
    {
        $nienKhoa = $lop->nienKhoa;

        if ($nienKhoa && $nienKhoa->nam_ket_thuc <= now()->year) {
            return redirect()->route('giangvien.lichthi.index')
                ->with('error', 'Lớp đã hết kỳ để tạo thời khóa biểu');
        }
        $today = now();
        $dsHocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
                        ->where('ngay_ket_thuc', '>=', $today)
                        ->orderBy('ngay_bat_dau')
                        ->get();
       
        if ($request->filled('hoc_ky')) {
            $hocKy = HocKy::find($request->hoc_ky);
        } else {
            $hocKy = $dsHocKy->first();
        }
       
        $monHoc = collect();
        if ($hocKy) {
            $monHoc =  MonHoc::whereHas('chiTietChuongTrinhDaoTaos', function ($query) use ($lop,$hocKy) {
                    $query->where('id_hoc_ky', $hocKy->id)
                        ->whereHas('chuongTrinhDaoTao', function ($subQuery) use ($lop) {
                            $subQuery->where('id_chuyen_nganh', $lop->id_chuyen_nganh);
                        });
                })
                ->where('loai_mon_hoc', '!=', 5)
                ->get();
        }
        $tenMonHoc = $monHoc->pluck('ten_mon');        

        $dsLopHP = collect();
        $dsLopHP = LopHocPhan::where('id_lop', $lop->id)
            ->whereIn('ten_hoc_phan', $tenMonHoc)
            ->get();
        
        $dsTuan = Tuan::whereDate('ngay_bat_dau', '>=', $hocKy->ngay_bat_dau)
            ->whereDate('ngay_ket_thuc', '<=', $hocKy->ngay_ket_thuc)
            ->orderBy('tuan')
            ->get();


        $tuanDangChon = $request->filled('id_tuan')
            ? Tuan::find($request->id_tuan)
            : $dsTuan->first();

        $tuan = $tuanDangChon;
        
    
        $giam_thi = User::with('boMon.chuyenNganh.khoa')
        ->whereHas('boMon.chuyenNganh.khoa', function ($query) use ($lop) {
            $query->where('id', $lop->chuyenNganh->id_khoa);
        })
        ->get(); 

        $phong = Phong::all();
        return view('admin.lichthi.create', compact(
            'lop',
            'phong',
            'giam_thi',
            'hocKy',
            'dsLopHP',
            'dsTuan',
            'tuanDangChon',
            'monHoc'
        ));
    }
    public function store(Lop $lop,LichThiRequest $request)
    {
        $data=$request->validated();
        $tuan = Tuan::find($data['id_tuan']);
            
        if (!$tuan) {
            return redirect()->route('giangvien.lichthi.create',['lop'=>$lop])->with('error', 'Tuần không tồn tại');
        }

        $data['ngay_thi'] = Carbon::parse($tuan->ngay_bat_dau)->addDays($data['thu'] - 2)->format('Y-m-d');
       
        if ($this->isTrungLich($data) == true)  {
            return redirect()->route('giangvien.lichthi.create', ['lop' => $lop])
                ->with('error', 'Lịch thi đã bị trùng. Vui lòng kiểm tra lại các thông tin của lịch thi khác.');
        }
        
        $lichThi = LichThi::create($data);

        if ($lichThi) {
            return redirect()->route('giangvien.lichthi.create', ['lop' => $lop])
                ->with('success' , 'Lịch thi đã được tạo thành công.');
        }
    }
    public function isTrungLich($data)
    {
        $newStart = Carbon::parse($data['gio_bat_dau']);
        $newEnd = (clone $newStart)->addMinutes((int) $data['thoi_gian_thi']);
        
        $trungLHP = LichThi::where('id_lop_hoc_phan', $data['id_lop_hoc_phan'])
            ->where('lan_thi', $data['lan_thi'])
            ->exists();
        
        if ($trungLHP) {
            return true;
        }
        $tuan = Tuan::find($data['id_tuan']);
        $data['ngay_thi'] = Carbon::parse($tuan->ngay_bat_dau)->addDays($data['thu'] - 2)->format('Y-m-d');
        $lichPhong = LichThi::where('id_phong_thi', $data['id_phong_thi'])
            ->where('ngay_thi', $data['ngay_thi'])
            ->where('id_tuan', $data['id_tuan'])
            ->get();
        foreach ($lichPhong as $lich) {
            $oldStart = Carbon::parse($lich->gio_bat_dau);
            $oldEnd = (clone $oldStart)->addMinutes((int) $lich->thoi_gian_thi);

            if ($newStart->lt($oldEnd) && $newEnd->gt($oldStart)) {
                return true;
            }
        }
      
        $lichTrongNgay = LichThi::where('ngay_thi', $data['ngay_thi'])
            ->where('id_tuan', $data['id_tuan'])
            ->get();

        foreach ($lichTrongNgay as $lich) {
            $oldStart = Carbon::parse($lich->gio_bat_dau);
            $oldEnd = (clone $oldStart)->addMinutes((int) $lich->thoi_gian_thi);

            $trungGio = $newStart->lt($oldEnd) && $newEnd->gt($oldStart);

            if ($trungGio) {
                $giamThi1 = $data['id_giam_thi_1'];
                $giamThi2 = $data['id_giam_thi_2'] ?? null;

                if (
                    $lich->id_giam_thi_1 == $giamThi1 ||
                    $lich->id_giam_thi_2 == $giamThi1 ||
                    ($giamThi2 && (
                        $lich->id_giam_thi_1 == $giamThi2 ||
                        $lich->id_giam_thi_2 == $giamThi2
                    ))
                ) {
                    return true;
                }
            }
        }

        return false;
    }

    public function destroy(LichThi $lichThi)
    {
        if ($lichThi->delete()) {
            return redirect()->back()->with('success', 'Xóa lịch thi thành công.');
        }
        
    }
}