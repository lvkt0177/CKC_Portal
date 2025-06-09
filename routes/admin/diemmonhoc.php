<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\DiemMonHocController;

Route::resource('diemmonhoc', DiemMonHocController::class);
Route::get('/diemmonhoc/list/{id?}', [DiemMonHocController::class, 'list'])->name('diemmonhoc.list');
Route::post('/cap-nhat-diem', [DiemMonHocController::class, 'capNhat'])->name('diemmonhoc.cap-nhat-diem');