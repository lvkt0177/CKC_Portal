<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\SecurityController;

Route::get('/bao-mat/doi-mat-khau', [SecurityController::class, 'showChangePassword'])->name('bao-mat.doi-mat-khau');
Route::post('/bao-mat/doi-mat-khau', [SecurityController::class, 'changePassword'])->name('bao-mat.doi-mat-khau.post');