<?php

namespace App\Repositories\ThongBao;

use App\Repositories\RepositoryInterface;
use Illuminate\Support\Collection;

/**
 * The repository interface for the Permission Model
 */
interface ThongBaoRepositoryInterface extends RepositoryInterface
{
    public function thongBaoSinhVien($sinhVienId);
}
