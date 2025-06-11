<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BienBan\BienBanRepositoryInterface;
use App\Repositories\BienBan\BienBanRepository;
use App\Repositories\ChiTietBienBan\ChiTietBienBanRepositoryInterface;
use App\Repositories\ChiTietBienBan\ChiTietBienBanRepository;
use App\Repositories\ThongBao\ThongBaoRepositoryInterface;
use App\Repositories\ThongBao\ThongBaoRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BienBanRepositoryInterface::class, BienBanRepository::class);
        $this->app->bind(ChiTietBienBanRepositoryInterface::class, ChiTietBienBanRepository::class);
        $this->app->bind(ThongBaoRepositoryInterface::class, ThongBaoRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}