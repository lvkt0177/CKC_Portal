<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\HocPhiController;

Route::resource('hocphi', HocPhiController::class)->only([
    'index',
]);