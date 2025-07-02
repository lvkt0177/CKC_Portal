<?php

// routes/api/admin/admin.php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use App\Http\Controllers\Api\Auth\AuthLoginController;

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
    });
});

