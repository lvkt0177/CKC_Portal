<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthLoginController;

Route::get('/login', [AuthLoginController::class, 'index'])->name('login');
Route::get('/login/student', [AuthLoginController::class, 'studentSupport'])->name('login.student');

Route::post('/login-user', [AuthLoginController::class, 'userLogin'])->name('doLogin');

Route::post('/student/login-student', [AuthLoginController::class, 'studentLogin'])->name('doLoginStudent');

Route::get('/login/user-reset-password', [AuthLoginController::class, 'userResetPassword'])->name('login.user-reset-password');

Route::post('/sinh-vien-yeu-cau-cap-mat-khau', [AuthLoginController::class, 'svYeuCauCapMatKhau']);

Route::post('/user/lay-lai-mat-khau', [AuthLoginController::class, 'userLayLaiMatKhau']);