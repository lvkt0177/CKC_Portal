<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\LopHocPhanController;

Route::resource('lop-hoc-phan', LopHocPhanController::class)->only([
    'index',
]);