<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;

//Controller

use App\Http\Controllers\Api\Admin\CTDTController;

Route::resource('ctdt', CTDTController::class)->only('index','create');
Route::post('/khoi-tao-tuan', [CTDTController::class,'store'])->name('ctdt.store');
Route::get('/danhsach-tuan', [CTDTController::class, 'show'])->name('ctdt.show');
Route::get('/get-mon-hoc-ctdt', [CTDTController::class, 'getMonHocAndChiTietCTDT']);