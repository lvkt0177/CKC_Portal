<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\HocPhi;
use App\Models\HocKy;
use Carbon\Carbon;
use App\Models\SinhVien;
use App\Models\LopHocPhan;
use App\Models\DangKyHGTL;
use App\Models\DanhSachHocPhan;
use App\Enum\LoaiDangKy;
use Illuminate\Support\Facades\DB;

class  PaymentAPIService
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
        $vnp_OrderInfo = $data['order_info'];
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['total_vnpay'] * 100;
        $vnp_Data_Orther = $data['data_other'] ?? '';
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
        
        return $vnp_Url;
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
            $orderInfoRaw = $filteredData['vnp_OrderInfo'] ?? '';
            $orderInfo = json_decode($orderInfoRaw, true);
            $data = [
                'transactionId' => $filteredData['vnp_TxnRef'] ?? '',
                'amount' => number_format(($filteredData['vnp_Amount'] ?? 0) / 100, 0, ',', '.') . ' VNĐ',
                'time' => $filteredData['vnp_PayDate'] 
                    ? \Carbon\Carbon::createFromFormat('YmdHis', $filteredData['vnp_PayDate'])->format('d/m/Y - H:i:s')
                    : '',
                'orderInfo' => $orderInfo['message'] ?? '',
                'paymentMethod' => $filteredData['vnp_CardType'] ?? '',
                'status' => $filteredData['vnp_ResponseCode'] == '00' ? 'success' : 'failed',
                'orderType' => $filteredData['vnp_OrderType'] ?? 'other',
                'type' => $orderInfo['type'] ?? 'other',
                'so_tien' => $filteredData['vnp_Amount'] / 100 ?? 0,
            ];


            if($data['status'] == 'success') {
                if($data['type'] == 'hoc_phi') {
                    $this->updateHocPhi();
                }
                if($data['type'] == 'hoc_ghep') {
                    $this->updateHocPhiHocGhepThiLai($orderInfo['id_lop_hoc_phan'], $data['so_tien'], LoaiDangKy::HOCGHEP->value);
                    $this->updateDanhSachHocPhan($orderInfo['id_lop_hoc_phan']);
                }
                if($data['type'] == 'thi_lai') {
                    $this->updateHocPhiHocGhepThiLai($orderInfo['id_lop_hoc_phan'], $data['so_tien'], LoaiDangKy::THILAI->value);
                }
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
                $hocPhi->ngay_dong = Carbon::now();
                $hocPhi->trang_thai = 1;
                $hocPhi->save();                        
            }
        }
    }

    protected function updateDanhSachHocPhan($id_lop_hoc_phan): void
    {
        $sinhVien = Auth::guard('student')->user();
        $lopHocPhan = DanhSachHocPhan::create([
            'id_sinh_vien' => $sinhVien->id,
            'id_lop_hoc_phan' => $id_lop_hoc_phan,
            'loai_hoc' => 1,
        ]);
        $lopHocPhan->save();
    }

    protected function updateHocPhiHocGhepThiLai($id_lop_hoc_phan, $amount, $loai_dong): void
    {
        $sinhVien = Auth::guard('student')->user();
        $dangKyHocGhep = DangKyHGTL::create([
            'id_sinh_vien' => $sinhVien->id,
            'id_lop_hoc_phan' => $id_lop_hoc_phan,
            'so_tien' =>  $amount,
            'loai_dong' =>  $loai_dong, 
            'trang_thai' => 1, 
        ]);
    }
}