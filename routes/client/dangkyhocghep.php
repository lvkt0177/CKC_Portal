<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DangKyHocGhepController;

Route::get('/dang-ky-hoc-ghep/lop-hoc-ghep', [DangKyHocGhepController::class, 'index'])->name('dang-ky-hoc-ghep.index');

Route::get('/dang-ky-hoc-ghep/lop/{id}', [DangKyHocGhepController::class, 'list'])->name('dang-ky-hoc-ghep.list');
Route::get('/lop-dang-ky-hoc-ghep/dang-ky/lich-su', [DangKyHocGhepController::class, 'history'])->name('dang-ky-hoc-ghep.history');