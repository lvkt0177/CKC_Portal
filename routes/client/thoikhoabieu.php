<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ThoiKhoaBieuController;



Route::get('/thoi-khoa-bieu', [ThoiKhoaBieuController::class, 'index'])->name('thoikhoabieu.index');