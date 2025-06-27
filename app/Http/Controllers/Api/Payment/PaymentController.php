<?php

namespace App\Http\Controllers\Api\Payment;

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
        return response()->json([
            'url' => $url,
        ]);
    }

    private function tinhTienTheoTinChi($soTinChi, $loaiMon)
    {
        switch ($loaiMon) {
            case 0:
                return $soTinChi * 200000;
            case 1:
                return $soTinChi * 250000;
            default:
                return 0;
        }
    }

    public function vnpay_hoc_ghep(Request $request, LopHocPhan $lopHocPhan)
    {
        $idSinhVien = Auth::guard('student')->id();
        
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

    public function vnpay_thi_lai()
    {
        $data['order_info'] = json_encode([
            'message' => 'Thanh toán thi lại',
            'type' => 'thi_lai',
            'id_lop_hoc_phan' => 1 //Cập nhật ID lớp học phần
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