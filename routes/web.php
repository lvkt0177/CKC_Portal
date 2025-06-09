<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
//Controller


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');



Route::group(['middleware' => 'web'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {

        include('admin/auth.php');
        
        include('admin/profile.php');

        Route::get('/dashboard', function () {
            return view('admin.dashboard.index');
        })->name('dashboard');
        //--------------------------------------
        //Route chức năng
        Route::middleware(['auth.admin', 'role_or_permission:' . Acl::ROLE_SUPER_ADMIN . '|' . Acl::ROLE_ADMIN . '|' . Acl::ROLE_STAFF])->group(function () {


            include('admin/role.php');


            include('admin/sinhvien.php');

            include('admin/giangvien.php');

            include('admin/permission.php');

            include('admin/phong.php');

            include('admin/giayxacnhan.php');

            include('admin/diemmonhoc.php');

            include('admin/lop.php');

            include('admin/bienbanshcn.php');

            include('admin/phieulenlop.php');

        });


    });

});