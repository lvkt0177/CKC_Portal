<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use App\Http\Controllers\Admin\ProfileController;

Route::resource('profile', ProfileController::class);

Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');


