<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller

use App\Http\Controllers\Api\Admin\LopHocPhanController;

Route::resource('lop-hoc-phan', LopHocPhanController::class)->only(['index']);