<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProfileController;


Route::get('/ho-so', [ProfileController::class, 'index'])->name('ho-so.index');