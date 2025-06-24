<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HocPhiController;

Route::resource('hocphi', HocPhiController::class);