<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
//Controller

Route::prefix('giangvien')->name('giangvien.')->group(function () {

    include('profile.php');
    include('portal.php');
    //--------------------------------------
    Route::middleware([
        'auth.admin', 
        'role_or_permission:' . Acl::ROLE_SUPER_ADMIN . '|' . Acl::ROLE_PHONG_DAO_TAO . '|' . Acl::ROLE_PHONG_CONG_TAC_CHINH_TRI . '|' . Acl::ROLE_GIANG_VIEN_BO_MON . '|' . Acl::ROLE_GIANG_VIEN_CHU_NHIEM . '|' . Acl::ROLE_TRUONG_KHOA
    ])->group(function () {
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
    