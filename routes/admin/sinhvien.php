<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller
use App\Http\Controllers\Admin\SinhVienController;

Route::get('/student', [SinhVienController::class, 'index'])->name('student.index');





