<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use App\Http\Controllers\Api\Client\BienBanController;

Route::get('/bienbanshcn', [BienBanController::class, 'index'])->name('bienbanshcn.index');

Route::post('/bienbanshcn/store/{lop}', [BienBanController::class, 'store'])->name('bienbanshcn.store');

Route::get('/bienbanshcn/chitiet/{bienBanSHCN}', [BienBanController::class, 'show'])->name('bienbanshcn.show');

Route::delete('/bienbanshcn/sinhvienvang/{id}', [BienBanController::class, 'deleteSinhVienVang'])->name('bienbanshcn.sinhvienvang');

Route::get('/bienbanshcn/thuky', [BienBanController::class, 'list'])->name('bienbanshcn.list');

Route::resource('bienbanshcn', BienBanController::class)->except(['index','create','store','show']);

Route::delete('/bienbanshcn/{bienBanSHCN}', [BienBanController::class, 'destroy'])->name('bienbanshcn.destroy');
