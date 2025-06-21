<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

use App\Http\Controllers\Api\Admin\NienKhoaController;

Route::get('/nien-khoa', [NienKhoaController::class, 'getNienKhoaWithHocKy']);