<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DangKyHocGhepController;

Route::resource('dang-ky-hoc-ghep', DangKyHocGhepController::class);