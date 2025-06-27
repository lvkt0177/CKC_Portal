<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthLoginController;


Route::post('/sinh-vien/yeu-cau-cap-mat-khau', [AuthLoginController::class, 'sinhVienYeuCauCapMatKhau']);

Route::post('/user/lay-lai-mat-khau', [AuthLoginController::class, 'userResetPasswordPost']);