<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\ThoiKhoaBieuController;

Route::get('/thoi-khoa-bieu', [ThoiKhoaBieuController::class, 'index']);
Route::get('/thoi-khoa-bieu/giang-vien', [ThoiKhoaBieuController::class, 'thoiKhoaBieuCuaGiangVien']);
Route::post('/thoi-khoa-bieu', [ThoiKhoaBieuController::class, 'store']);
Route::post('/thoi-khoa-bieu/{tkb}', [ThoiKhoaBieuController::class, 'update']);
Route::delete('/thoi-khoa-bieu/xoa-thoi-khoa-bieu/{tkb}', [ThoiKhoaBieuController::class, 'destroy']);
Route::post('/thoi-khoa-bieu/copy-tuan/{tkb}', [ThoiKhoaBieuController::class, 'copyWeekToWeek']);