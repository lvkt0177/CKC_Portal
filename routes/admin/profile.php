<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;


Route::get('/profile', function () {
    return view('admin.profile.index');
})->name('profile.index');


