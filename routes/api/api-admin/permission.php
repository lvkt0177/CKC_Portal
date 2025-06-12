<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Api\Admin\PermissionController;

Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
   