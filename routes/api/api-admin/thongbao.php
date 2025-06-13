<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
//Controller
use App\Http\Controllers\Api\Admin\ThongBaoController;

Route::delete('/thongbao/file/{id}', [ThongBaoController::class, 'destroyFile'])->name('thongbao.file.destroy');

Route::resource('thongbao', ThongBaoController::class)->except(['create', 'edit']);

// Route::get('/thongbao/file/download/{id}', [ThongBaoController::class, 'download'])->name('file.download');

Route::post('/thongbao/send-to-student/{thongbao}', [ThongBaoController::class, 'sendToStudent'])->name('thongbao.send-to-student');

Route::get('/thongbao/get-data-cap-tren', [ThongBaoController::class, 'prepareCreateData']);
