<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LichThiController;


Route::resource('lichthi', LichThiController::class)->only('store, update, destroy');