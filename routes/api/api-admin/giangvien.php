<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use App\Http\Controllers\Api\Admin\GiangVienController;
//Controller


Route::resource('giangvien', GiangVienController::class)->only(['index', 'show']);
