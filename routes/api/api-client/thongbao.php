<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\ThongBaoController;

Route::resource('thong-bao', ThongBaoController::class)->only(['index']);

Route::get('/thong-bao/{thongbao}', [ThongBaoController::class, 'show'])->name('thong-bao.show');

Route::post('/thong-bao/binh-luan/{thongbao}', [ThongBaoController::class, 'storeComment']);
Route::delete('/thong-bao/xoa-binh-luan/{binhLuan}', [ThongBaoController::class, 'destroyComment']);