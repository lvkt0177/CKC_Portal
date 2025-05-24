<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\RoleController;


Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');


