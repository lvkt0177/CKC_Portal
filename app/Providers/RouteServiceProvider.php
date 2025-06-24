<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Đường dẫn mặc định sau khi login
     */
    public const HOME = '/home';

    /**
     * Đăng ký route cho ứng dụng
     */
    public function boot(): void
    {
        parent::boot();

        Route::middleware([]) 
            ->group(base_path('routes/public.php'));

        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }
}
