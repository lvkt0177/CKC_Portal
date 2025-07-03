<?php

namespace App\Repositories\BienBan;

use App\Repositories\RepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Lop;
use Illuminate\Database\Eloquent\Model;

/**
 * The repository interface for the Permission Model
 */
interface BienBanRepositoryInterface
{
    public function getByLopWithRelations(Model $lop);
    public function getByLopWithRelationsByIdLop($lop_id, $perPage = 10);

    public function create($data);

    public function update($model, array $data);
}
