<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\LichThiController;


Route::prefix('lich-thi')->name('api.admin.lich-thi.')->group(function () {
    Route::get('/danh-sach-lich-thi', [LichThiController::class, 'index']);
    Route::post('/tao-lich-thi', [LichThiController::class, 'store']);
    Route::post('/cap-nhat-lich-thi/{lichThi}', [LichThiController::class, 'update']);
    Route::delete('/xoa-lich-thi/{lichThi}', [LichThiController::class, 'destroy']);
});