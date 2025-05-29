<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller

use App\Http\Controllers\Admin\GiangVienController;

Route::get('/giangvien', [GiangVienController::class, 'index'])->name('giangvien.index');