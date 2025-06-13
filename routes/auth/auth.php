<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthLoginController;


Route::get('/login', [AuthLoginController::class, 'index'])->name('login');
Route::get('/login/student', [AuthLoginController::class, 'studentSupport'])->name('login.student');
Route::get('/login/user-reset-password', [AuthLoginController::class, 'userResetPassword'])->name('login.user-reset-password');

Route::post('/login-user', [AuthLoginController::class, 'userLogin'])->name('doLogin');
Route::post('/student/login-student', [AuthLoginController::class, 'studentLogin'])->name('doLoginStudent');

Route::get('/logout', [AuthLoginController::class, 'logout'])->name('logout');
Route::get('/student/logout', [AuthLoginController::class, 'studentLogout'])->name('studentLogout');

Route::post('/sinh-vien/yeu-cau-cap-mat-khau', [AuthLoginController::class, 'sinhVienYeuCauCapMatKhau'])->name('sinh-vien.yeu-cau-cap-mat-khau');
