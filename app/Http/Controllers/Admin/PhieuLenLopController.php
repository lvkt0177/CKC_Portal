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
use App\Http\Requests\PhieuLenLop\PhieuLenLopRequest;
use Illuminate\Support\Facades\Auth;

class PhieuLenLopController extends Controller
{
    //
    public function index(Request $request)
    {
        $today = now();
        $namDangChon = $request->nam ?? $today->year;

        // Tìm bản ghi năm
        $nam = Nam::where('nam_bat_dau', $namDangChon)->first();
        if (!$nam) {
            $nam = Nam::where('nam_bat_dau', $today->year)->first();
        }

        // Tuần đang chọn
        $tuanDangChon = $request->id_tuan ?? $today->weekOfYear;

        // Tìm tuần theo năm và số tuần
        $tuan = Tuan::where('id_nam', $nam->id)
                    ->where('tuan', $tuanDangChon)
                    ->first();

        // Nếu không có, fallback tuần hiện tại
        if (!$tuan) {
            $tuan = Tuan::where('id_nam', $nam->id)
                        ->whereDate('ngay_bat_dau', '<=', $today)
                        ->whereDate('ngay_ket_thuc', '>=', $today)
                        ->first();
        }

        // Xử lý hành động: tuần trước hoặc hiện tại
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

        // Lấy phiếu lên lớp theo tuần
        $phieu_len_lop = PhieuLenLop::with([
            'lopHocPhan', 'lopHocPhan.lop', 'lopHocPhan.giangVien.hoSo', 'phong', 'tuan'
        ])
        ->whereBetween('ngay', [$tuan->ngay_bat_dau, $tuan->ngay_ket_thuc])
        ->whereHas('lopHocPhan', function ($query) {
            $query->where('id_giang_vien', Auth::user()->id);
        })
        ->orderBy('ngay')
        ->get();

        // Tạo danh sách ngày trong tuần
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
        $lopHocPhan = LopHocPhan::where('id_giang_vien',Auth::user()->id)->get();
        if ($lopHocPhan->isEmpty()) {
        return redirect()->route('admin.phieulenlop.index')
            ->with('error', 'Bạn chưa được phân công lớp học phần nào, không thể tạo phiếu lên lớp.');
        }
        
        $phong = Phong::all();
        $tuan = Tuan::orderBy('tuan')->get();
        $siSoArray = [];
        foreach ($lopHocPhan as $lhp) {
            $siSoArray[$lhp->id] = $lhp->danhSachHocPhan()->count();
        }
        return view('admin.phieulenlop.create', compact('lopHocPhan', 'phong', 'tuan','siSoArray'));
    }
    public function store(PhieuLenLopRequest $request)
        {
           
          

            // Tìm tuần phù hợp với ngày học
            $tuan = Tuan::whereDate('ngay_bat_dau', '<=', $request->ngay)
                        ->whereDate('ngay_ket_thuc', '>=', $request->ngay)
                        ->first();

            if (!$tuan) {
                return back()->withErrors(['ngay' => 'Ngày học không thuộc bất kỳ tuần nào. Vui lòng chọn ngày khác.'])->withInput();
            }

            // Lấy tất cả dữ liệu request thành mảng
            $data = $request->validated();
            
            // Gán thêm id_tuan tìm được
            $data['id_tuan'] = $tuan->id;
           
            // Tạo bản ghi
            PhieuLenLop::create($data);

            return redirect()->route('admin.phieulenlop.index')->with('success', 'Đã tạo phiếu lên lớp thành công.');
        }

        public function getSiSo($id)
        {
            $soLuong = danhSachHocPhan::where('id_lop_hoc_phan', $id)->count();
            dd($soLuong);
            return response()->json(['si_so' => $soLuong]);
        }

}