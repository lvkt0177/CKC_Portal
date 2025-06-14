<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use Illuminate\Support\Facades\Mail;
use App\Mail\GuiMatKhauMoi;
use App\Jobs\SendMailJob;

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
