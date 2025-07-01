<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller

use App\Http\Controllers\Api\Admin\LopHocPhanController;

Route::resource('lop-hoc-phan', LopHocPhanController::class)->only(['index']);
Route::get('lop-hoc-phan/giang-vien', [LopHocPhanController::class, 'lopHocPhanTheoGiangVien']);
Route::post('lop-hoc-phan/phan-cong-giang-vien/{lopHocPhan}', [LopHocPhanController::class, 'phanCongGiangVien']);
  