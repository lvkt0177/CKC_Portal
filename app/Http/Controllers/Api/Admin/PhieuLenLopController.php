<?php

namespace App\Http\Controllers\Api\Admin;

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
use Carbon\Carbon;

class PhieuLenLopController extends Controller
{
    // api/admin/phieu-len-lop: truyền tham số: nam, id_tuan
    public function index(Request $request)
    {
        $today = now();
        $namDangChon = $request->nam ?? $today->year;

        $nam = Nam::where('nam_bat_dau', $namDangChon)->first()
             ?? Nam::where('nam_bat_dau', $today->year)->first();

        $tuanDangChon = $request->id_tuan ?? $today->weekOfYear;

        $tuan = Tuan::where('id_nam', $nam->id)
                    ->where('tuan', $tuanDangChon)
                    ->first()
             ?? Tuan::where('id_nam', $nam->id)
                    ->whereDate('ngay_bat_dau', '<=', $today)
                    ->whereDate('ngay_ket_thuc', '>=', $today)
                    ->first();

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
            $query->where('id_giang_vien', Auth::id());
        })
        ->orderBy('ngay')
        ->get();

        $ngayTrongTuan = [];
        $bat_dau = Carbon::parse($tuan->ngay_bat_dau);
        $ket_thuc = Carbon::parse($tuan->ngay_ket_thuc);
        while ($bat_dau->lte($ket_thuc)) {
            $ngayTrongTuan[] = $bat_dau->toDateString();
            $bat_dau->addDay();
        }

        return response()->json([
            'status' => true,
            'tuan' => $tuan,
            'ngay_trong_tuan' => $ngayTrongTuan,
            'data' => $phieu_len_lop,
        ]);
    }

    // api/admin/phieu-len-lop/create
    public function create()
    {
        $lopHocPhan = LopHocPhan::where('id_giang_vien', Auth::id())->get();

        if ($lopHocPhan->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn chưa được phân công lớp học phần nào, không thể tạo phiếu lên lớp.'
            ], 403);
        }

        $phong = Phong::all();
        $tuan = Tuan::orderBy('tuan')->get();

        $siSoArray = [];
        foreach ($lopHocPhan as $lhp) {
            $siSoArray[$lhp->id] = $lhp->danhSachHocPhan()->count();
        }

        return response()->json([
            'status' => true,
            'lop_hoc_phan' => $lopHocPhan,
            'phong' => $phong,
            'tuan' => $tuan,
            'si_so' => $siSoArray
        ]);
    }

    // api/admin/phieu-len-lop/store - Tham số phải có: id_lop_hoc_phan, tiet_bat_dau, so_tiet, ngay, id_phong, si_so, hien_dien, noi_dung
    public function store(PhieuLenLopRequest $request)
    {
        $tuan = Tuan::whereDate('ngay_bat_dau', '<=', $request->ngay)
                    ->whereDate('ngay_ket_thuc', '>=', $request->ngay)
                    ->first();

        if (!$tuan) {
            return response()->json([
                'status' => false,
                'errors' => ['ngay' => 'Ngày học không thuộc bất kỳ tuần nào. Vui lòng chọn ngày khác.']
            ], 422);
        }

        $data = $request->validated();
        $data['id_tuan'] = $tuan->id;

        $phieu = PhieuLenLop::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Đã tạo phiếu lên lớp thành công.',
            'data' => $phieu
        ]);
    }

    // api/admin/phieu-len-lop/get-si-so - Tham số phải có: id
    public function getSiSo($id)
    {
        $soLuong = DanhSachHocPhan::where('id_lop_hoc_phan', $id)->count();

        return response()->json([
            'status' => true,
            'si_so' => $soLuong
        ]);
    }
}
