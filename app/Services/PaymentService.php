<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\HocPhi;
use App\Models\HocKy;
use Carbon\Carbon;

class PaymentService
{
    protected string $vnp_TmnCode = 'U4PG4M2O';
    protected string $vnp_HashSecret = 'U0ZBWWF07HXOQYZL2ZR823GINKU3X1O7';
    protected string $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';

    public function createPaymentUrl(array $data): string
    {
        $code_cart = rand(00, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "U4PG4M2O";
        $vnp_HashSecret = "U0ZBWWF07HXOQYZL2ZR823GINKU3X1O7";

        $vnp_TxnRef = rand(1,10000);
        $vnp_OrderInfo = 'Thanh toan hoc phi';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['total_vnpay'] * 100;
        $vnp_Locale = 'vn';
        // $vnp_BankCode = 'VNPAYQR';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
        'code' => '00',
        'message' => 'success',
        'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
        } else {
        echo json_encode($returnData);
        }
    }

    public function handleReturn(array $inputData): array|string
    {
        $vnp_HashSecret = "U0ZBWWF07HXOQYZL2ZR823GINKU3X1O7";

        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? null;

        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);

        $filteredData = [];
        foreach ($inputData as $key => $value) {
            if (str_starts_with($key, 'vnp_')) {
                $filteredData[$key] = $value;
            }
        }

        ksort($filteredData);

        $hashData = "";
        $i = 0;
        foreach ($filteredData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            $data = [
                'transactionId' => $filteredData['vnp_TxnRef'] ?? '',
                'amount' => number_format(($filteredData['vnp_Amount'] ?? 0) / 100, 0, ',', '.') . ' VNĐ',
                'time' => $filteredData['vnp_PayDate'] 
                    ? \Carbon\Carbon::createFromFormat('YmdHis', $filteredData['vnp_PayDate'])->format('d/m/Y - H:i:s')
                    : '',
                'orderInfo' => $filteredData['vnp_OrderInfo'] ?? '',
                'paymentMethod' => $filteredData['vnp_CardType'] ?? '',
                'status' => $filteredData['vnp_ResponseCode'] == '00' ? 'success' : 'failed',
            ];
            if($data['status'] == 'success') {
                $this->updateHocPhi();
            }
            return view('client.hocphi.result', compact('data'));

        } else {
            return "Chữ ký không hợp lệ!";
        }
    }

    protected function updateHocPhi(): void
    {
        $sinhVien = Auth::guard('student')->user();
        $now = now()->toDateString();
                
        $hocKyHienTai = HocKy::whereDate('ngay_bat_dau', '<=', $now)
        ->where('ngay_ket_thuc', '>=', $now)
        ->first();
                
        $hocPhi = null;
                
        if ($hocKyHienTai) {
            $hocPhi = HocPhi::where('id_hoc_ky', $hocKyHienTai->id)
            ->where('id_sinh_vien', $sinhVien->id)
            ->first();
            
            if($hocPhi->trang_thai->value == 0) {
                $hocPhi->trang_thai = 1;
                $hocPhi->save();                        
            }
        }
    }
}