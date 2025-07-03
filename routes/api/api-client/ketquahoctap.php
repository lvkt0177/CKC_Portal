<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\KetQuaHocTapController;

Route::resource('ket-qua-hoc-tap', KetQuaHocTapController::class)->only([
    'index',
]);