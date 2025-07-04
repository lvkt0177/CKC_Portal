<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use App\Http\Controllers\Api\Admin\ChuyenNganhController;

Route::get('chuyen-nganh', [ChuyenNganhController::class, 'getChuyenNganhWithKhoa']);