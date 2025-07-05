<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\KetQuaHocTapController;

Route::get('/ket-qua-hoc-tap', [KetQuaHocTapController::class, 'index']);