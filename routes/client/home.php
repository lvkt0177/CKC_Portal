<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;

Route::resource('home', HomeController::class);
