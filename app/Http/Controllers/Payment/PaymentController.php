<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HocPhi;
use App\Models\SinhVien;
use App\Models\HocKy;
use App\Models\LopHocPhan;
use App\Models\Lop;
use App\Services\PaymentService;
use App\Http\Requests\Payment\PaymentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\DanhSachHocPhan;
use App\Models\DangKyHGTL;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function vnpay_payment(PaymentRequest $request)
    {
        $data = $request->validated();
        $data['order_info'] = json_encode([
            'message' => 'Thanh toán học phí',
            'type' => 'hoc_phi',
        ]);
        $url = $this->paymentService->createPaymentUrl($data);
        
        return redirect()->away($url);
    }

    private function tinhTienTheoTinChi($soTinChi, $loaiMon)
    {
        switch ($loaiMon) {
            case 0:
                return $soTinChi * 200000;
            case 1:
                return $soTinChi * 250000;
            case 2:
                return $soTinChi * 200000;
            default:
                return 0;
        }
    }

    public function vnpay_hoc_ghep(Request $request, LopHocPhan $lopHocPhan)
    {
        if($lopHocPhan->gioi_han_dang_ky == 0) {
            return redirect()->back()->with('error', 'Lớp học phần này đã đủ số lượng đăng ký.');
        }
        $idSinhVien = Auth::guard('student')->id();

        $exists = DanhSachHocPhan::where('id_sinh_vien', $idSinhVien)
        ->where('id_lop_hoc_phan', $lopHocPhan->id)
        ->exists();
        
        if ($exists) {
            return redirect()->back()->with('error', 'Bạn đã đăng ký lớp học phần này rồi!');
        }

        $monHoc = DB::table('danh_sach_hoc_phan as dshp')
            ->join('lop_hoc_phan as lhp', 'lhp.id', '=', 'dshp.id_lop_hoc_phan')
            ->join('mon_hoc as mh', 'mh.ten_mon', '=', 'lhp.ten_hoc_phan')
            ->join('chi_tiet_ctdt as ct', 'ct.id_mon_hoc', '=', 'mh.id')
            ->where('dshp.id_sinh_vien', $idSinhVien)
            ->where('dshp.diem_tong_ket', '<', 5)
            ->where('mh.id','=', $request->id_mon_hoc)
            ->select(
                'ct.so_tin_chi',
            )
            ->distinct()
            ->first();
        
        $tien = $this->tinhTienTheoTinChi($monHoc->so_tin_chi, $lopHocPhan->loai_mon->value);
        $data = [
            'order_info' => json_encode([
                'message' => 'Thanh toán học ghép '.$lopHocPhan->ten_hoc_phan,
                'type' => 'hoc_ghep',
                'id_lop_hoc_phan' => $lopHocPhan->id,
            ]),
            'total_vnpay' => number_format($tien, 2, '.', ''),
        ];
        $url = $this->paymentService->createPaymentUrl($data);
        return redirect($url);
    }

    public function vnpay_thi_lai(LopHocPhan $lopHocPhan)
    {
        $sinhVien = Auth::guard('student')->user();
        
        $exists = DangKyHGTL::where('id_sinh_vien', $sinhVien->id)->where('id_lop_hoc_phan', $lopHocPhan->id)->where('loai_dong', 1)->exists();
        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã đăng ký thi lại môn này rồi',
            ]);
        }

        $data['order_info'] = json_encode([
            'message' => 'Thanh toán thi lại',
            'type' => 'thi_lai',
            'id_lop_hoc_phan' => $lopHocPhan->id
        ]);
        $data['total_vnpay'] = number_format(50000, 2, '.', ''); 
        $url = $this->paymentService->createPaymentUrl($data);
        return redirect($url);
    }

    public function vnpayReturn(Request $request)
    {
        $result = $this->paymentService->handleReturn($request->query());

        if (is_string($result)) {
            return $result;
        }

        return view('client.hocphi.result', ['data' => $result]);
    }
}