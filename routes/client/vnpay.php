<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\PaymentController;


Route::get('/payment/vnpay', [PaymentController::class, 'createPayment'])->name('vnpay.payment');
Route::get('/vnpay-return', [PaymentController::class, 'return'])->name('vnpay.return');
Route::get('/vnpay-ipn', [PaymentController::class, 'ipn'])->name('vnpay.ipn');
