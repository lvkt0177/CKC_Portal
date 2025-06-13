<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
//Controller


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
