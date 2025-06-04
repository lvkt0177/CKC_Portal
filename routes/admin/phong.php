<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\RoomController;


Route::resource('phong', RoomController::class)->except(['destroy']);
