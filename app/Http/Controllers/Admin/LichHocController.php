<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ThoiKhoaBieu\ThoiKhoaBieuRequest;
use Carbon\Carbon;

//Model
use Illuminate\Support\Facades\Auth;
use App\Models\Lop;
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
class LichHocController extends Controller
{
    //
    public function index(Request $request)
    {
        $nienKhoas = NienKhoa::orderBy('id', 'desc')->get();
        $nganhHocs = NganhHoc::orderBy('id', 'desc')->get();

        $id_nien_khoa = $request->input('id_nien_khoa') ?? NienKhoa::where('nam_bat_dau', '<', Carbon::now()->year)
            ->where('nam_ket_thuc', '>=', Carbon::now()->year)
            ->orderByDesc('nam_ket_thuc')
            ->first()?->id;
        $id_nganh_hoc = $request->input('id_nganh_hoc');
        
        $lops = Lop::with([
           'giangVien','giangVien.hoSo'
        ])->where('id_nien_khoa', $id_nien_khoa)
            ->when($id_nganh_hoc, function ($query) use ($id_nganh_hoc) {
                return $query->whereHas('giangVien.boMon.nganhHoc', function ($q) use ($id_nganh_hoc) {
                    $q->where('id', $id_nganh_hoc);
                });
            })
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.lichhoc.index', compact('lops', 'nienKhoas', 'id_nien_khoa', 'id_nganh_hoc', 'nganhHocs'));
    }

    public function list(Request $request,Lop $lop)
    {   

    
        $today = now();

        // Lấy danh sách học kỳ theo lớp
        $dsHocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)->orderBy('ngay_bat_dau')->get();
        if ($dsHocKy->count() > 0) {
            $dsHocKy->pop(); 
        }
        // Xác định học kỳ đang chọn
        $hoc_ky_id = $request->hoc_ky;
        
        $hocKy = $hoc_ky_id
            ? HocKy::find($hoc_ky_id)
            : HocKy::where('ngay_bat_dau', '<=', $today)->where('ngay_ket_thuc', '>=', $today)->first();

        if (!$hocKy) {
            $hocKy = HocKy::where('ngay_ket_thuc', '<=', $today)->orderByDesc('ngay_ket_thuc')->first();
        }

        // Lấy danh sách tuần trong học kỳ
        $dsTuan = Tuan::whereDate('ngay_bat_dau', '>=', $hocKy->ngay_bat_dau)
                    ->whereDate('ngay_ket_thuc', '<=', $hocKy->ngay_ket_thuc)
                    ->orderBy('tuan')->get();

       
        // Xác định tuần đang chọn
        $tuanDangChon = $request->id_tuan
            ? Tuan::find($request->id_tuan)
            : $dsTuan->first(); 
        
        $tuan = $tuanDangChon;

        // Lấy các ngày trong tuần
        $ngayTrongTuan = collect();
        if ($tuan) {
            $bat_dau = \Carbon\Carbon::parse($tuan->ngay_bat_dau);
            $ket_thuc = \Carbon\Carbon::parse($tuan->ngay_ket_thuc);
            while ($bat_dau->lte($ket_thuc)) {
                $ngayTrongTuan->push($bat_dau->copy());
                $bat_dau->addDay();
            }
        }

        // Lấy thời khóa biểu
        $thoikhoabieu = ThoiKhoaBieu::with([
            'lopHocPhan',
            'lopHocPhan.lop',
            'lopHocPhan.giangVien.hoSo',
            'phong',
            'tuan'
        ])
        ->whereHas('lopHocPhan', function ($query) use ($lop) {
            $query->where('id_lop', $lop->id);
        })
        ->where('id_tuan', $tuan->id ?? null)
        ->get();

        return view('admin.lichhoc.list', compact('ngayTrongTuan','thoikhoabieu','lop','dsHocKy','dsTuan','hocKy','tuanDangChon'));
    }
    public function create(Request $request, Lop $lop)
    {
        $nienKhoa = $lop->nienKhoa;

        if ($nienKhoa && $nienKhoa->nam_ket_thuc <= Carbon::now()->year) {
            return redirect()->route('giangvien.lichhoc.index')
                ->with('error', 'Lớp đã hết kỳ để tạo thời khóa biểu');
        }

        // Lấy danh sách 3 học kỳ tương lai của lớp
        $dsHocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
            ->where('ngay_bat_dau', '>', Carbon::today())
            ->orderBy('ngay_bat_dau')
            ->take(3)
            ->get();

        // Lấy ID học kỳ được chọn từ request (nếu không có thì lấy học kỳ đầu tiên)
        $id_hoc_ky = $request->hoc_ky ?? $dsHocKy->first()?->id;
        
        $hocKy = $id_hoc_ky
            ? HocKy::find($id_hoc_ky)
            : HocKy::where('ngay_bat_dau', '<=', $today)->where('ngay_ket_thuc', '>=', $today)->first();

        if (!$hocKy) {
            $hocKy = HocKy::where('ngay_ket_thuc', '<=', $today)->orderByDesc('ngay_ket_thuc')->first();
        }
        // Mặc định danh sách môn học rỗng
        $monHoc = collect();

        $dsTuan = Tuan::whereDate('ngay_bat_dau', '>=', $hocKy->ngay_bat_dau)
                        ->whereDate('ngay_ket_thuc', '<=', $hocKy->ngay_ket_thuc)
                        ->orderBy('tuan')->get();

        // Xác định tuần đang chọn
        $tuanDangChon = $request->id_tuan
            ? Tuan::find($request->id_tuan)
            : $dsTuan->first(); // tuần đầu tiên học kỳ
       
        $tuan = $tuanDangChon;
        
    if ($id_hoc_ky) {
        $monHoc = MonHoc::whereHas('chiTietChuongTrinhDaoTaos', function ($query) use ($lop, $id_hoc_ky) {
                $query->where('id_hoc_ky', $id_hoc_ky)
                    ->whereHas('chuongTrinhDaoTao', function ($q) use ($lop) {
                        $q->whereHas('chuyenNganh', function ($sub) use ($lop) {
                            $sub->where('id_nganh_hoc', $lop->id_nganh_hoc);
                        });
                    });
            })
            ->where('loai_mon_hoc', '!=', 2)
            ->get();
        }

        $phong = Phong::all();
        
        $ngayTrongTuan = collect();
        if ($tuanDangChon) {
            $bat_dau = \Carbon\Carbon::parse($tuan->ngay_bat_dau);
            $ket_thuc = \Carbon\Carbon::parse($tuan->ngay_ket_thuc);
            while ($bat_dau->lte($ket_thuc)) {
                $ngayTrongTuan->push($bat_dau->copy());
                $bat_dau->addDay();
            }
        }
        $thoikhoabieu = ThoiKhoaBieu::with([
            'lopHocPhan',
            'lopHocPhan.lop',
            'lopHocPhan.giangVien.hoSo',
            'phong',
            'tuan'
        ])
        ->whereHas('lopHocPhan', function ($query) use ($lop) {
            $query->where('id_lop', $lop->id);
        })
        ->where('id_tuan', $tuan->id ?? null)
        ->get();
        return view('admin.lichhoc.create', compact('lop', 'dsHocKy', 'monHoc', 'phong', 'id_hoc_ky','tuanDangChon','dsTuan','ngayTrongTuan','thoikhoabieu','hocKy'));
    }

    public function store(ThoiKhoaBieuRequest $request)
    {
        dd($request->validated());
        return redirect()->route('admin.lichhoc.create')
        ->with('success', 'Thêm thành công');
    }


}