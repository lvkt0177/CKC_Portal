<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
//Controller

Route::prefix('giangvien')->name('giangvien.')->group(function () {

    include('profile.php');
    //--------------------------------------
    Route::middleware(['auth.admin', 'role_or_permission:' . Acl::ROLE_SUPER_ADMIN . '|' . Acl::ROLE_ADMIN . '|' . Acl::ROLE_STAFF])->group(function () {
        
        include('portal.php');
        include('role.php');
        include('sinhvien.php');
        include('giangvien.php');
        include('permission.php');
        include('phong.php');
        include('giayxacnhan.php');
        include('diemmonhoc.php');
        include('lop.php');
        include('bienbanshcn.php');
        include('phieulenlop.php');
        include('thongbao.php');
        // include('binhluan.php');
        include('capmatkhau.php');
        include('lichhoc.php');
        include('lichthi.php');
        include('ctdt.php');
    });
});
    