<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Api\Admin\SinhVienController;

Route::get('lopsinhvien', [SinhVienController::class, 'index']);
Route::get('lopsinhvien/{id}', [SinhVienController::class, 'showlist']);
Route::post('lopsinhvien/{sinhVien}/chucvu', [SinhVienController::class, 'doiChucVu']);
