<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Admin\GiangVienController;

use App\Http\Controllers\API\Auth\AdminLoginController;


Route::prefix('admin')->group(function () {

    Route::post('/login', [AdminLoginController::class, 'login']);

   Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', [AdminLoginController::class, 'logout']);

        Route::resource('giangvien', GiangVienController::class)->only(['index', 'show']);

    
   });
});
