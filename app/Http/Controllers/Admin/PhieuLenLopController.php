<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhieuLenLop;
use App\Models\LopHocPhan;
use App\Models\DanhSachHocPhan;
use App\Models\Phong;
use App\Models\Tuan;
use App\Models\Nam;
use App\Models\ThoiKhoaBieu;
use App\Http\Requests\PhieuLenLop\PhieuLenLopRequest;
use Illuminate\Support\Facades\Auth;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use App\Acl\Acl;

class PhieuLenLopController extends Controller
{
    public function __construct() {
        $this->middleware('permission:' . Acl::PERMISSION_VIEW_CLASS_RECORD, ['only' => ['index']]);
        $this->middleware('permission:' . Acl::PERMISSION_CREATE_CLASS_RECORD, ['only' => ['create', 'store']]);
    }
    public function index(Request $request)
    {
        $today = now();
       
        $nam = Nam::where('nam_bat_dau', $request->nam)->first();
        
        if (!$nam) {
            $nam = Nam::where('nam_bat_dau', $today->year)->first();
        }
    
        $tuanDangChon = $request->id_tuan;

        $tuan = Tuan::where('id_nam', $nam->id)
                    ->where('tuan', $tuanDangChon)
                    ->first();
        
        if (!$tuan) {
            $tuan = Tuan::where('id_nam', $nam->id)
                        ->whereDate('ngay_bat_dau', '<=', $today)
                        ->whereDate('ngay_ket_thuc', '>=', $today)
                        ->first();
        }
        if (!$tuan) {
            return back()->with('error', 'Không tìm thấy tuần phù hợp.');
        }
        if ($request->action === 'prev') {
            $tuan = Tuan::where('id_nam', $nam->id)
                        ->where('tuan', '<', $tuan->tuan)
                        ->orderByDesc('tuan')
                        ->first() ?? $tuan;
        } elseif ($request->action === 'current') {
            $tuan = Tuan::where('id_nam', $nam->id)
                        ->whereDate('ngay_bat_dau', '<=', $today)
                        ->whereDate('ngay_ket_thuc', '>=', $today)
                        ->first() ?? $tuan;
        }
        $phieu_len_lop = PhieuLenLop::with([
            'lopHocPhan', 'lopHocPhan.lop', 'lopHocPhan.giangVien.hoSo', 'phong', 'tuan'
        ])
        ->whereBetween('ngay', [$tuan->ngay_bat_dau, $tuan->ngay_ket_thuc])
        ->whereHas('lopHocPhan', function ($query) {
            $query->where('id_giang_vien', Auth::user()->id);
        })
        ->orderBy('ngay')
        ->get();
        $ngayTrongTuan = collect();
        $bat_dau = \Carbon\Carbon::parse($tuan->ngay_bat_dau);
        $ket_thuc = \Carbon\Carbon::parse($tuan->ngay_ket_thuc);
        while ($bat_dau->lte($ket_thuc)) {
            $ngayTrongTuan->push($bat_dau->copy());
            $bat_dau->addDay();
        }

        return view('admin.phieulenlop.index', compact(
            'phieu_len_lop', 'ngayTrongTuan', 'tuan'
        ));
    }

    public function create()
    {
        $today = now();
        $lopHocPhan = ThoiKhoaBieu::whereDate('ngay', $today)
        ->with('lopHocPhan') 
        ->get()
        ->pluck('lopHocPhan') 
        ->filter();
        
        if ($lopHocPhan->isEmpty()) {
        return redirect()->route('giangvien.phieulenlop.index')
            ->with('error', 'Hôm nay bạn không có lịch của lớp nào.');
        }
        
        $phong = Phong::all();
        $tuan = Tuan::orderBy('tuan')->get();
       
        return view('admin.phieulenlop.create', compact('lopHocPhan'));
    }
    public function store(PhieuLenLopRequest $request)
    {
        $data = $request->validated();
      
        $today  = now();
        $id_lhp = $request->validated('id_lop_hoc_phan');
        $lhp    = LopHocPhan::find($id_lhp);
      
        $tuan   = Tuan::whereDate('ngay_bat_dau', '<=', $today)
                    ->whereDate('ngay_ket_thuc', '>=', $today)
                    ->first();
        $tkb    = ThoiKhoaBieu::where('id_lop_hoc_phan', $id_lhp)
                ->where('id_tuan', $tuan->id)
                ->first();
        $data['id_tuan']        = $tuan->id;
        $data['tiet_bat_dau']   = $tkb->tiet_bat_dau;
        $data['tiet_ket_thuc']  = $tkb->tiet_ket_thuc;
        $data['so_tiet']        = $data['tiet_ket_thuc'] - $data['tiet_bat_dau'] + 1;
        $data['id_phong']       = $tkb->id_phong;
        $data['ngay']           = $tkb->ngay;
       
        $tietBatDauMoi = $data['tiet_bat_dau'];
        $tietKetThucMoi = $data['tiet_ket_thuc'];
        
        
        $trungTiet = PhieuLenLop::whereDate('ngay', $request->ngay)
            ->where(function ($query) use ($tietBatDauMoi, $tietKetThucMoi) {
                $query->whereRaw('? <= (tiet_bat_dau + so_tiet - 1)', [$tietKetThucMoi])
                    ->whereRaw('? >= tiet_bat_dau', [$tietBatDauMoi]);
            })
            ->exists();

        if ($trungTiet) {
            return redirect()->route('giangvien.phieulenlop.index')
                ->with('error', 'Đã có phiếu lên lớp trùng khung tiết trong ngày này.');
        }


        PhieuLenLop::create($data);

        return redirect()->route('giangvien.phieulenlop.index')->with('success', 'Đã tạo phiếu lên lớp thành công.');
    }

    public function getSiSo($id)
    {
        $soLuong = danhSachHocPhan::where('id_lop_hoc_phan', $id)->count();
        dd($soLuong);
        return response()->json(['si_so' => $soLuong]);
    }

    /**
     * L y danh s ch ph i u l n l p v  tr  v  view qua l  ph i u l n l p
     *
     * @return \Illuminate\Http\Response
     */
    public function quanLyPhieuLenLop()
    {
        $phieuLenLop = PhieuLenLop::with([
            'lopHocPhan', 'lopHocPhan.lop', 'lopHocPhan.giangVien.hoSo', 'phong', 'tuan'
        ])
        ->orderBy('ngay')
        ->get();

        return view('admin.phieulenlop.manage', compact('phieuLenLop'));
    }
}