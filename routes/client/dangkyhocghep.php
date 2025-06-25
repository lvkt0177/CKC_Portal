<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DangKyHocGhepController;

Route::resource('dang-ky-hoc-ghep', DangKyHocGhepController::class);

Route::get('/dang-ky-hoc-ghep/lop/{id}', [DangKyHocGhepController::class, 'list'])->name('dang-ky-hoc-ghep.list');