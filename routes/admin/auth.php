<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Auth\TeacherLoginController;


Route::get('/login', [TeacherLoginController::class, 'index'])->name('login');

Route::post('/login', [TeacherLoginController::class, 'login'])->name('login.post');

Route::get('/logout', [TeacherLoginController::class, 'logout'])->name('logout');