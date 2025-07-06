<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use App\Http\Controllers\Admin\BienBanController;

Route::get('/bienbanshcn/{lop}', [BienBanController::class, 'index'])->name('bienbanshcn.index');
Route::get('/bienbanshcn/create/{lop}', [BienBanController::class, 'create'])->name('bienbanshcn.create');
Route::post('/bienbanshcn/store/{lop}', [BienBanController::class, 'store'])->name('bienbanshcn.store');

Route::get('/bienbanshcn/chitiet/{bienBanSHCN}', [BienBanController::class, 'show'])->name('bienbanshcn.show');

Route::delete('/bienbanshcn/sinhvienvang/{id}', [BienBanController::class, 'deleteSinhVienVang'])->name('bienbanshcn.sinhvienvang');

Route::post('/bienbanshcn/confirm/{bienBanSHCN}', [BienBanController::class, 'confirmBienBan'])->name('bienbanshcn.confirm');

Route::resource('bienbanshcn', BienBanController::class)->except(['index','create','store','show']);