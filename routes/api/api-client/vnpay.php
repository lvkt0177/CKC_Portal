<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Payment\PaymentController;



Route::get('sinhvien/vnpay-return', [PaymentController::class, 'vnpayReturn'])->name('api.vnpay.return');

Route::get('sinhvien/vnpay-ipn', [PaymentController::class, 'ipn'])->name('vnpay.ipn');
