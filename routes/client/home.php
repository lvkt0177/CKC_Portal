<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;

Route::resource('trang-chu', HomeController::class);
