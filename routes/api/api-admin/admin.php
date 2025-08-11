<?php

// routes/api/admin/admin.php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use App\Http\Controllers\Api\Auth\AuthLoginController;

Route::prefix('admin')->name('api.admin.')->group(function () {

    // include('portal.php');
    Route::post('/login', [AuthLoginController::class, 'login']);
    //--------------------------------------------------------
    Route::middleware([
        'auth:sanctum',
        'role_or_permission:' . Acl::ROLE_SUPER_ADMIN . '|' . Acl::ROLE_PHONG_DAO_TAO . '|' . Acl::ROLE_PHONG_CONG_TAC_CHINH_TRI . '|' . Acl::ROLE_GIANG_VIEN_BO_MON . '|' . Acl::ROLE_GIANG_VIEN_CHU_NHIEM . '|' . Acl::ROLE_TRUONG_KHOA
        ])->group(function () {
        include('auth.php');
        include('role.php');
        include('lopsinhvien.php');
        include('giangvien.php');
        include('permission.php');
        include('phong.php');
        include('giayxacnhan.php');
        include('phieulenlop.php');
        include('thongbao.php');
        include('lop.php');
        include('diemmonhoc.php');
        include('nienkhoa.php');
        include('chuyennganh.php');
        include('bomon.php');
        include('lophocphan.php');
        include('bienbanshcn.php');
        include('thongbao.php');
        include('chuongtrinhdaotao.php');
        include('thoikhoabieu.php');
        include('lichthi.php');
        include('profile.php');

    });
});