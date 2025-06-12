<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
//Controller

Route::group(['middleware' => 'web'], function () {

    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    include('admin/admin.php');
});

include('ckeditor/ckeditor.php');
