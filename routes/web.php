<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use Illuminate\Support\Facades\Mail;
use App\Mail\GuiMatKhauMoi;
use App\Jobs\SendMailJob;
use App\Http\Controllers\Payment\PaymentController;

Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay.create');

Route::middleware([])->group(function () {
    Route::get('/payment/vnpay', [PaymentController::class, 'createPayment'])->name('vnpay.payment');
    Route::get('/vnpay-return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');
    Route::get('/vnpay-ipn', [PaymentController::class, 'ipn'])->name('vnpay.ipn');
});

Route::group(['middleware' => 'web'], function () {

    include('auth/auth.php');
    
    Route::get('/', function () {
        return redirect()->route('login');
    });
    
    // Admin
    include('admin/admin.php');

    // Client
    include('client/client.php');
});

include('ckeditor/ckeditor.php');
   
   
