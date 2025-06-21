<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ChiTietThongBao;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $count = 0;
            if (Auth::guard('student')->check()) {
                $count = ChiTietThongBao::where('id_sinh_vien', Auth::guard('student')->id())
                    ->where('TRANG_THAI', 0)
                    ->count();
            }
            $view->with('unreadNotificationCount', $count);
        });
    }
}