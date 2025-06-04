<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller

use App\Http\Controllers\API\Admin\GiangVienController;

Route::resource('giangvien', GiangVienController::class)->only(['index', 'show']);
