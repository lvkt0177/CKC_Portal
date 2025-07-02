<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Payment\PaymentController;


Route::post('sinhvien/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay.create');

Route::post('sinhvien/payment/vnpay/thi-lai', [PaymentController::class, 'vnpay_thi_lai'])->name('vnpay.payment.thi-lai');

Route::post('sinhvien/payment/vnpay/hoc-ghep/{lopHocPhan}', [PaymentController::class, 'vnpay_hoc_ghep'])->name('vnpay.payment.hoc-ghep');


Route::get('sinhvien/vnpay-return', [PaymentController::class, 'vnpayReturn'])->name('api.vnpay.return');

Route::get('sinhvien/vnpay-ipn', [PaymentController::class, 'ipn'])->name('vnpay.ipn');
