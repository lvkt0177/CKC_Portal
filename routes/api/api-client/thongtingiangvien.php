<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\ThongTinGiangVienController;

Route::resource('thong-tin-giang-vien', ThongTinGiangVienController::class)->only(['index']);