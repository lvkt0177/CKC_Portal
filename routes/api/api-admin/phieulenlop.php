<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Api\Admin\PhieuLenLopController;

Route::get('/phieu-len-lop', [PhieuLenLopController::class, 'index']);
Route::get('/phieu-len-lop/create', [PhieuLenLopController::class, 'create']);
Route::post('/phieu-len-lop/store', [PhieuLenLopController::class, 'store']);
Route::get('/phieu-len-lop/si-so/{id}', [PhieuLenLopController::class, 'getSiSo']);

Route::get('/phieu-len-lop/all', [PhieuLenLopController::class, 'quanLyPhieuLenLop']);