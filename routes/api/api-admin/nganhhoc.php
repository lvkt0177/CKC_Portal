<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use App\Http\Controllers\Api\Admin\NganhHocController;

Route::get('nganh-hoc', [NganhHocController::class, 'getNganhHocWithKhoa']);