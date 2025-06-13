<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
//Controller
use App\Http\Controllers\Admin\ThongBaoController;

Route::delete('/thongbao/file/{id}', [ThongBaoController::class, 'destroyFile'])->name('thongbao.file.destroy');

Route::resource('thongbao', ThongBaoController::class);

Route::get('/thongbao/file/download/{id}', [ThongBaoController::class, 'download'])->name('file.download');

Route::post('/thongbao/send-to-student/{thongbao}', [ThongBaoController::class, 'sendToStudent'])->name('thongbao.send-to-student');