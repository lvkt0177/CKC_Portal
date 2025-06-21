<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

//Model
use App\Models\DanhSachHocPhan;
use App\Models\SinhVien;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\MonHoc;
use App\Models\ChuongTrinhDaoTao;
use App\Models\LopHocPhan;
use App\Models\Lop;
use App\Models\LoaiGiay;
use App\Models\DangKyGiay;
use Carbon\Carbon;

class DKGiayController extends Controller
{
    //
    public function index()
    {
        $id_sv = Auth::guard('student')->user()->id;
        $sinhVien = SinhVien::with('hoSo','lop')->where('id', $id_sv)->first();
        $giayXacNhans =LoaiGiay::get();
        return view('client.giayxacnhan.index', compact('sinhVien','giayXacNhans'));
    }
    public function list()
    {
        $id_sv = Auth::guard('student')->user()->id;
        $dsgiay = DangKyGiay::with('sinhVien', 'loaiGiay', 'giangVien', 'sinhVien.hoSo', 'giangVien.hoSo')
            ->where('id_sinh_vien', $id_sv)
            ->orderBy('trang_thai', 'asc')
            ->paginate(5);
        return view('client.giayxacnhan.list', compact('dsgiay'));
    }
    public function store(Request $request)
    {
        $sinhVien = Auth::guard('student')->user();
        $giayIds = $request->input('document_type', []);

        if (empty($giayIds)) {
            return redirect()->back()->with('error', 'Chưa có loại giấy nào được chọn');
        }

        $ngayNhan = now()->addWeek();
        while (!in_array($ngayNhan->dayOfWeek, [Carbon::WEDNESDAY, Carbon::FRIDAY])) {
            $ngayNhan->addDay();
        }

        $daTonTai = [];
        $daDangKyMoi = [];

        foreach ($giayIds as $id_giay) {
            $daDangKy = DangKyGiay::where('id_sinh_vien', $sinhVien->id)
                ->where('id_loai_giay', $id_giay)
                ->where('trang_thai', 0)
                ->exists();

            if ($daDangKy) {
                $daTonTai[] = $id_giay;
                continue;
            }

            DangKyGiay::create([
                'id_sinh_vien' => $sinhVien->id,
                'id_giang_vien' => null,
                'id_loai_giay' => $id_giay,
                'ngay_dang_ky' => Carbon::now(),
                'ngay_nhan' => $ngayNhan,
                'trang_thai' => 0,
            ]);

            $daDangKyMoi[] = $id_giay;
        }

        // Xử lý thông báo
        if (count($daTonTai) === count($giayIds)) {
            return redirect()->back()->with('error', 'Các giấy đã chọn đều đã được đăng ký và đang chờ xử lý.');
        }

        if (!empty($daTonTai)) {
            return redirect()->back()->with('success', 'Một số giấy đã được đăng ký trước. Các giấy còn lại đã được đăng ký thành công.');
        }

        return redirect()->back()->with('success', 'Đăng ký thành công.');
    }
}