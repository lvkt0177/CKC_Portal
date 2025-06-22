<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Api\Admin\GiayXacNhanController;

Route::get('giay-xac-nhan', [GiayXacNhanController::class, 'index']);
Route::put('giay-xac-nhan', [GiayXacNhanController::class, 'update']);
