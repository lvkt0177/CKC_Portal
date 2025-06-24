<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\GiayXacNhanController;
use App\Http\Controllers\Admin\CTDTController;

Route::resource('testimonial', GiayXacNhanController::class);
Route::post('/testimonial/{id}/update', [GiayXacNhanController::class, 'update'])->name('testimonial.update');