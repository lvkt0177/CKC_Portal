<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AdminLoginController;

Route::post('/logout', [AdminLoginController::class, 'logout']);