<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProfileController;

// Route::resource('ho-so', ProfileController::class);

Route::get('/ho-so/doi-mat-khau', [ProfileController::class, 'showChangePassword'])->name('ho-so.doi-mat-khau');
Route::post('/ho-so/doi-mat-khau', [ProfileController::class, 'changePassword'])->name('ho-so.doi-mat-khau.post');