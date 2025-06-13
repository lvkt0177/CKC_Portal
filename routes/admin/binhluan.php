<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\BinhLuanController;

Route::post('/binhluan',[BinhLuanController::class,'create'])->name('binhluan.add');

