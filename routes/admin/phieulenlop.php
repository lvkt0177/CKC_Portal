<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\PhieuLenLopController;

Route::resource('phieulenlop', PhieuLenLopController::class)->only(['index', 'show']);