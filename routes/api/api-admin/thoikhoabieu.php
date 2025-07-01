<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\ThoiKhoaBieuController;

Route::post('/thoi-khoa-bieu', [ThoiKhoaBieuController::class, 'store']);
Route::post('/thoi-khoa-bieu/{tkb}', [ThoiKhoaBieuController::class, 'update']);
Route::delete('/thoi-khoa-bieu/xoa-thoi-khoa-bieu/{tkb}', [ThoiKhoaBieuController::class, 'destroy']);