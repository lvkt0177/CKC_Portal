<?php

// routes/api/admin/admin.php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use App\Http\Controllers\Api\Auth\AuthLoginController;
use App\Http\Controllers\Api\Payment\PaymentController;

Route::prefix('sinhvien')->name('api.sinhvien.')->group(function () {
    
    Route::post('/login', [AuthLoginController::class, 'studentLogin']);
    //--------------------------------------------------------
    Route::middleware([
        'auth:sanctum',
        ])->group(function () {
        
            Route::post('/logout', [AuthLoginController::class, 'studentLogout']);
            include('giayxacnhan.php');
            include('khungdaotao.php');
            include('bienbanshcn.php');
            include('hocphi.php');
            include('thongbao.php');
            include('diemrenluyen.php');
            include('thongtingiangvien.php');
            include('lichthi.php');
            include('lophocphan.php');
            include('thoikhoabieu.php');
            include('ketquahoctap.php');
            include('dangkyhocghep.php');
            Route::post('vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay.create');
            Route::post('payment/vnpay/thi-lai/{lopHocPhan}', [PaymentController::class, 'vnpay_thi_lai'])->name('vnpay.payment.thi-lai');
            Route::post('payment/vnpay/hoc-ghep/{lopHocPhan}', [PaymentController::class, 'vnpay_hoc_ghep'])->name('vnpay.payment.hoc-ghep');
            
    });
});

