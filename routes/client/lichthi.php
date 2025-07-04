<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\LichThiController;

Route::resource('lichthi', LichThiController::class)->only(['index']);
Route::get('lichthi/dang-ky-thi-lan-hai', [LichThiController::class, 'listLichThiLanHai'])->name('lichthi.thilailanhai');