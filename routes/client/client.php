<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProfileController;

Route::prefix('sinhvien')->name('sinhvien.')->group(function () {
    
    Route::middleware('auth:student')->group(function () {
        
        include('home.php');
        include('profile.php');
        
    });
});
