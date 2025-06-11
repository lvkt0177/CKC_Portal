<?php

use Illuminate\Support\Facades\Route;
use App\Acl\Acl;
use App\Http\Controllers\Admin\PortalController;
//Controller

Route::resource('portal', PortalController::class)->except(['destroy']);
