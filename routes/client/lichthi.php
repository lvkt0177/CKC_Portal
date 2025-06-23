<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\LichThiController;

Route::resource('lichthi', LichThiController::class);