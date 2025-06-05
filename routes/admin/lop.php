<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller

use App\Http\Controllers\Admin\LopController;

Route::resource('lop', LopController::class)->only(['index']);