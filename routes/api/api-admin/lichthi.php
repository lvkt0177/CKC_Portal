<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\LichThiController;


Route::prefix('lich-thi')->name('api.admin.lich-thi.')->group(function () {
    Route::post('/tao-lich-thi', [LichThiController::class, 'store'])->name('store');
    Route::put('/cap-nhat-lich-thi/{id}', [LichThiController::class, 'update'])->name('update');
    Route::delete('/xoa-lich-thi/{id}', [LichThiController::class, 'destroy'])->name('destroy');
});