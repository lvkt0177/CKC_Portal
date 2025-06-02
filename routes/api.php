<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Admin\GiangVienController;

Route::get('/user', function () {
    return response()->json(['message' => 'pong']);
});


Route::resource('giangvien', GiangVienController::class)->only(['index', 'show']);
