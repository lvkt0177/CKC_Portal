<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthLoginController;

Route::post('/logout', [AuthLoginController::class, 'logout']);