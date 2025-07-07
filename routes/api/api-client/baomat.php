<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\SecurityController;

Route::post('/bao-mat/doi-mat-khau', [SecurityController::class, 'changePassword'])->name('bao-mat.doi-mat-khau.post');