<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
//Controller

Route::prefix('admin')->name('admin.')->group(function () {

    include('auth.php');
    include('profile.php');
    include('portal.php');
    //--------------------------------------
    Route::middleware(['auth.admin', 'role_or_permission:' . Acl::ROLE_SUPER_ADMIN . '|' . Acl::ROLE_ADMIN . '|' . Acl::ROLE_STAFF])->group(function () {

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

    });
});
    
