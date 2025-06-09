<?php

namespace App\Repositories\ChiTietBienBan;

use App\Repositories\RepositoryInterface;
use Illuminate\Support\Collection;

/**
 * The repository interface for the Permission Model
 */
interface ChiTietBienBanRepositoryInterface extends RepositoryInterface
{
    public function updateOrCreate(array $condition, array $data);
}
