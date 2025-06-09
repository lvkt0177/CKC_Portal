<?php

namespace App\Repositories\BienBan;

use App\Repositories\RepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Lop;

/**
 * The repository interface for the Permission Model
 */
interface BienBanRepositoryInterface
{
    public function getByLopWithRelations(Lop $lop);

    public function create($data);

    public function update($model, array $data);
}
