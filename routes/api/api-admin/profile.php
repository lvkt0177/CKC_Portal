<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use App\Http\Controllers\Admin\ProfileController;

Route::post('/doi-mat-khau', [ProfileController::class, 'changePassword']);


