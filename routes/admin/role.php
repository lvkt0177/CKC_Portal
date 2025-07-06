<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\RoleController;


Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');


Route::post('/roles/add/{user}', [RoleController::class, 'addRoleForUser'])->name('roles.addRoleForUser');

Route::post('/roles/remove/{user}', [RoleController::class, 'removeRoleForUser'])->name('roles.removeRoleForUser');

Route::post('/roles/delete/{role}', [RoleController::class, 'deleteRoleByKey'])->name('roles.deleteRoleByKey');

Route::get('/roles/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');

Route::put('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.update-permissions');
