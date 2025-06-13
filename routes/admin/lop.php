<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller

use App\Http\Controllers\Admin\LopController;

Route::resource('lop', LopController::class)->only(['index']);

Route::get('/lop/sinhvien/{lop}', [LopController::class, 'list'])->name('lop.sinhvien');
Route::get('/lop/nhap-diem_rl/{lop}', [LopController::class, 'nhapDiemRL'])->name('lop.nhap-diem_rl');
Route::post('/lop/cap-nhat-diem_rl', [LopController::class, 'capNhatDiemRL'])->name('lop.cap-nhat-diem_rl');
Route::post('/lop/cap-nhat-diem-checked', [LopController::class, 'capNhatDiemChecked'])->name('lop.cap-nhat-diem-checked');