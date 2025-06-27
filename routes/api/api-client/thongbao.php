<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\ThongBaoController;

Route::resource('thong-bao', ThongBaoController::class)->only(['index']);

Route::get('/thong-bao/{thongbao}', [ThongBaoController::class, 'show'])->name('thong-bao.show');