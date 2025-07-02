<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller

use App\Http\Controllers\Admin\GiangVienController;

Route::resource('giangvien', GiangVienController::class)->only(['index', 'show']);

Route::get('/lich-day', [GiangVienController::class, 'xemLichDay'])->name('giangvien.lichday');