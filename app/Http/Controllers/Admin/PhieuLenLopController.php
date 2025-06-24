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
       
        $nam = Nam::where('nam_bat_dau', $request->nam)->first();
        
        if (!$nam) {
            $nam = Nam::where('nam_bat_dau', $today->year - 1)->first();
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
        $tietBatDauMoi = $data['tiet_bat_dau'];
        $tietKetThucMoi = $tietBatDauMoi + $data['so_tiet'] - 1;

        // Kiểm tra giao tiết
        $trungTiet = PhieuLenLop::where('ngay', $request->ngay)
            ->where(function ($query) use ($tietBatDauMoi, $tietKetThucMoi) {
                $query->where(function ($q) use ($tietBatDauMoi, $tietKetThucMoi) {
                    $q->whereRaw("tiet_bat_dau <= ?", [$tietKetThucMoi])
                    ->whereRaw("(tiet_bat_dau + so_tiet - 1) >= ?", [$tietBatDauMoi]);
                });
            })
            ->exists();

        if ($trungTiet) {
            return redirect()->route('giangvien.phieulenlop.index')->with('error', 'Đã có phiếu lên lớp trùng khung tiết trong ngày này.');
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
}