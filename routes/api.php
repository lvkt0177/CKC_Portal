<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Admin\GiangVienController;


Route::resource('giangvien', GiangVienController::class)->only(['index', 'show']);
