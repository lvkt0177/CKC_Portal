<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
//Controller


Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});




Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');

    // Route::get('/roles', function () {
    //     return view('admin.roles.index');
    // })->name('roles.index');

});


Route::group(['middleware' => 'web'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        
        include('admin/auth.php');
        
        //--------------------------------------
        //Route chức năng
        Route::middleware(['auth.admin', 'role_or_permission:' . Acl::ROLE_SUPER_ADMIN . '|' . Acl::ROLE_ADMIN . '|' . Acl::ROLE_STAFF])->group(function () {

            Route::get('/dashboard', function () {
                return view('admin.dashboard.index');
            })->name('dashboard');
            
            include('admin/role.php');
            
        });

        
    });


    

});