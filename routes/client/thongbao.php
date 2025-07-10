<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ThongBaoController;

Route::resource('thong-bao', ThongBaoController::class)->only(['index']);

Route::get('/thong-bao/{thongbao}', [ThongBaoController::class, 'show'])->name('thong-bao.show');

Route::get('/thongbao/file/download/{id}', [ThongBaoController::class, 'download'])->name('file.download');