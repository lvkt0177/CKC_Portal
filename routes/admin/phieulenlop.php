<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\PhieuLenLopController;

Route::resource('phieulenlop', PhieuLenLopController::class)->only(['index', 'store','create']);
Route::get('/get-si-so/{id}', [PhieuLenLopController::class, 'getSiSo']);
Route::get('/phieulenlop/details{id}', [PhieuLenLopController::class, 'details'])->name('phieulenlop.details');
Route::get('/phieu-len-lop/quan-ly', [PhieuLenLopController::class, 'quanLyPhieuLenLop'])->name('phieulenlop.manage');