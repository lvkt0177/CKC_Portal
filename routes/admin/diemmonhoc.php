<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\DiemMonHocController;

Route::resource('diemmonhoc', DiemMonHocController::class);
Route::get('/diemmonhoc/list/{id?}', [DiemMonHocController::class, 'list'])->name('diemmonhoc.list');
Route::post('/diemmonhoc/update-trang-thai/{lopHocPhan}', [DiemMonHocController::class, 'updateTrangThai'])->name('diemmonhoc.updateTrangThai');
Route::post('/cap-nhat-diem', [DiemMonHocController::class, 'capNhat'])->name('diemmonhoc.cap-nhat-diem');
Route::get('/export-bang-diem/{lopHocPhan}', [DiemMonHocController::class, 'exportBangDiem'])->name('diemmonhoc.export');
Route::post('/diemmonhoc/bandiem/guibandiemtoisinhvien', [DiemMonHocController::class, 'guiBangDiemToiSinhVien'])->name('diemmonhoc.guibandiem');