<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\NhapDiemController;

Route::resource('enterpoint', NhapDiemController::class);
Route::get('/enterpoint/list/{id?}', [NhapDiemController::class, 'list'])->name('enterpoint.list');
Route::post('/cap-nhat-diem', [NhapDiemController::class, 'capNhat'])->name('enterpoint.cap-nhat-diem');