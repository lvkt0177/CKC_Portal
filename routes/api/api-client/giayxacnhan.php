<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\DKGiayController;


Route::get('/giay-xac-nhan', [DKGiayController::class, 'index'])->name('giayxacnhan.index');
Route::get('/danh-sach-giay-da-dang-ky', [DKGiayController::class, 'list'])->name('giayxacnhan.list');
Route::post('/dang-ky-giay', [DKGiayController::class, 'store'])->name('giayxacnhan.dangky');