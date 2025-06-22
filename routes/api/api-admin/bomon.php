<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

use App\Http\Controllers\Api\Admin\BoMonController;

Route::get('/bo-mon', [BoMonController::class, 'getBoMonWithRelation']);