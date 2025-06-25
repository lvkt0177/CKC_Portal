<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LichThiController;


Route::resource('lichthi', LichThiController::class)->only('store');

Route::get('/quan-ly-lich-thi', [LichThiController::class, 'index'])->name('lichthi.index');

Route::get('/quan-ly-lich-thi/{lop}', [LichThiController::class, 'show'])->name('lichthi.show');

Route::get('/tao-lich-thi/{lop}', [LichThiController::class, 'create'])->name('lichthi.create');