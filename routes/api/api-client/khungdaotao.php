<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\KDTController;

Route::get('/khung-dao-tao', [KDTController::class, 'index'])->name('khungdaotao.index');