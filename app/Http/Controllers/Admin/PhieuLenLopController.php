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

        $nam = Nam::where('nam_bat_dau', $namDangChon)->first();
        if (!$nam) {
            $nam = Nam::where('nam_bat_dau', $today->year)->first();
        }

        $tuanDangChon = $request->id_tuan ?? $today->weekOfYear;

        $tuan = Tuan::where('id_nam', $nam->id)
                    ->where('tuan', $tuanDangChon)
                    ->first();

        if (!$tuan) {
            $tuan = Tuan::where('id_nam', $nam->id)
                        ->whereDate('ngay_bat_dau', '<=', $today)
                        ->whereDate('ngay_ket_thuc', '>=', $today)
                        ->first();
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
        $tuan = Tuan::whereDate('ngay_bat_dau', '<=', $request->ngay)
                    ->whereDate('ngay_ket_thuc', '>=', $request->ngay)
                    ->first();

        if (!$tuan) {
            return back()->withErrors(['ngay' => 'Ngày học không thuộc bất kỳ tuần nào. Vui lòng chọn ngày khác.'])->withInput();
        }

        $data = $request->validated();
        
        $data['id_tuan'] = $tuan->id;
        
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