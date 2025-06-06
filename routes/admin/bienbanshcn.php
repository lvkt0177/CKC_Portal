<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;


use App\Http\Controllers\Admin\BienBanController;

Route::resource('bienbanshcn', BienBanController::class);