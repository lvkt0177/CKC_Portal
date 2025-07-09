<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LichThiController;




Route::get('/quan-ly-lich-thi', [LichThiController::class, 'index'])->name('lichthi.index');

Route::get('/quan-ly-lich-thi/{lop}', [LichThiController::class, 'xemLichThi'])->name('lichthi.show');

Route::get('/tao-lich-thi/{lop}', [LichThiController::class, 'create'])->name('lichthi.create');

Route::post('/tao-lich-thi/{lop}', [LichThiController::class, 'store'])->name('lichthi.store');

Route::delete('/xoa-lich-thi/{lichThi}', [LichThiController::class, 'destroy'])->name('lichthi.destroy');