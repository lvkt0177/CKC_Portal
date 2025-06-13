<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Api\Admin\SinhVienController;

Route::get('sinhvien', [SinhVienController::class, 'index']);
Route::get('sinhvien/{id}', [SinhVienController::class, 'showlist']);
Route::post('sinhvien/{sinhVien}/chucvu', [SinhVienController::class, 'doiChucVu']);
Route::post('sinhvien/{sinhVien}/khoa', [SinhVienController::class, 'khoaSinhVien']);
