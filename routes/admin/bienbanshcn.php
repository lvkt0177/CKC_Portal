<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;


use App\Http\Controllers\Admin\BienBanController;


Route::get('/bienbanshcn/{lop}', [BienBanController::class, 'index'])->name('bienbanshcn.index');
Route::resource('bienbanshcn', BienBanController::class)->except(['index']);