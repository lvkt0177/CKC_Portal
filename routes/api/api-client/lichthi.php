<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\LichThiController;

Route::resource('lich-thi', LichThiController::class)->only([
    'index',
]);

Route::get('lich-thi-lan-hai', [LichThiController::class, 'listLichThiLanHai']);