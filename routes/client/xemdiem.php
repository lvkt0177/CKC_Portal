<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\XemDiemController;

Route::get('/xemdiem/ket-qua-hoc-tap', [XemDiemController::class, 'ketquahoctap'])->name('xemdiem.ketquahoctap');
Route::get('/xemdiem/ket-qua-ren-luyen', [XemDiemController::class, 'ketquarenluyen'])->name('xemdiem.ketquarenluyen');