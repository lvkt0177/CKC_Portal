<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\RoleController;


Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');


Route::post('/roles/add/{user}', [RoleController::class, 'addRoleForUser'])->name('roles.addRoleForUser');

Route::post('/roles/remove/{user}', [RoleController::class, 'removeRoleForUser'])->name('roles.removeRoleForUser');