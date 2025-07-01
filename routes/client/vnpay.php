<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\PaymentController;


Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay.create');

Route::post('/payment/vnpay/thi-lai', [PaymentController::class, 'vnpay_thi_lai'])->name('vnpay.payment.thi-lai');

Route::post('/payment/vnpay/hoc-ghep/{lopHocPhan}', [PaymentController::class, 'vnpay_hoc_ghep'])->name('vnpay.payment.hoc-ghep');


Route::get('/vnpay-return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');
Route::get('/vnpay-ipn', [PaymentController::class, 'ipn'])->name('vnpay.ipn');
