<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\DiemRenLuyenController;

Route::resource('diem-ren-luyen', DiemRenLuyenController::class)->only(['index']);