<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CapMatKhauController;


Route::resource('capmatkhausinhvien', CapMatKhauController::class);
