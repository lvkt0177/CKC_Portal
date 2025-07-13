<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
//Controller
use App\Http\Controllers\Api\Admin\DiemMonHocController;
Route::get('/diem-mon-hoc', [DiemMonHocController::class, 'index']);
Route::get('/diem-mon-hoc/{id}', [DiemMonHocController::class, 'list']);
Route::post('/diem-mon-hoc/cap-nhat', [DiemMonHocController::class, 'capNhat']);
Route::post('/diem-mon-hoc/nop-bang-diem/{lopHocPhan}', [DiemMonHocController::class, 'updateTrangThai']);
Route::post('/diemmonhoc/bandiem/guibandiemtoisinhvien', [DiemMonHocController::class, 'guiBangDiemToiSinhVien'])->name('diemmonhoc.guibandiem');