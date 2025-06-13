<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\RoleController;

Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');