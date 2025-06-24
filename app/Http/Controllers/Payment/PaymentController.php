<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HocPhi;
use App\Models\SinhVien;
use App\Models\HocKy;
use App\Services\PaymentService;
use App\Http\Requests\Payment\PaymentRequest;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function vnpay_payment(PaymentRequest $request)
    {
        $url = $this->paymentService->createPaymentUrl($request->all());
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