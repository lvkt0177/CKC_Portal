<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\RoomController;


Route::get('/room', [RoomController::class, 'index'])->name('room.index');
    
Route::get('/room/create', [RoomController::class, 'create'])->name('room.create');

Route::post('/room', [RoomController::class, 'store'])->name('room.store');
