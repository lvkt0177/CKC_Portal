<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\SinhVienController;

Route::get('/student', [SinhVienController::class, 'index'])->name('student.index');
Route::get('/student/list/{id?}', [SinhVienController::class, 'showlist'])->name('student.list');


Route::post('/student/doi-chuc-vu/{danhSachSinhVien}', [SinhVienController::class, 'doiChucVu'])->name('student.doi-chuc-vu');

Route::post('/student/khoa-sinh-vien/{sinhVien}', [SinhVienController::class, 'khoaSinhVien'])->name('student.khoa-sinh-vien');