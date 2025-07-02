<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\ThoiKhoaBieuController;

Route::resource('thoi-khoa-bieu', ThoiKhoaBieuController::class)->only([
    'index',
]);