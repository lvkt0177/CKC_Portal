<?php

use App\Http\Controllers\Api\Admin\RoomController;

Route::get('/phong', [RoomController::class, 'index']);
Route::post('/phong', [RoomController::class, 'store']);
Route::get('/phong/{phong}', [RoomController::class, 'show']);
Route::put('/phong/{phong}', [RoomController::class, 'update']);
