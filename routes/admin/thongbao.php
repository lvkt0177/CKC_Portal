<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
//Controller
use App\Http\Controllers\Admin\ThongBaoController;

Route::resource('thongbao', ThongBaoController::class);
