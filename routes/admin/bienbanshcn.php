<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;


use App\Http\Controllers\Admin\BienBanController;

Route::prefix('/bienbanshcn')->name('bienbanshcn.')->group(function () {
    Route::get('/{type}/{id}', [BienBanController::class, 'index'])->name('index');
    Route::get('/create/{type}/{id}', [BienBanController::class, 'create'])->name('create');
    Route::post('/store/{type}/{id}', [BienBanController::class, 'store'])->name('store');
});

Route::get('/bienbanshcn/chitiet/{bienBanSHCN}', [BienBanController::class, 'show'])->name('bienbanshcn.show');

Route::delete('/bienbanshcn/sinhvienvang/{id}', [BienBanController::class, 'deleteSinhVienVang'])->name('bienbanshcn.sinhvienvang');

Route::post('/bienbanshcn/confirm/{bienBanSHCN}', [BienBanController::class, 'confirmBienBan'])->name('bienbanshcn.confirm');

Route::resource('bienbanshcn', BienBanController::class)->except(['index','create','store','show']);