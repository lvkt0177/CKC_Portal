<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LichHocController;


Route::resource('lichhoc', LichHocController::class)->only('store');

Route::get('/quan-ly-lich-hoc', [LichHocController::class, 'index'])->name('lichhoc.index');

Route::get('/quan-ly-lich-hoc/{lop}', [LichHocController::class, 'list'])->name('lichhoc.list');

Route::get('/tao-lich-hoc/{lop}', [LichHocController::class, 'create'])->name('lichhoc.create');