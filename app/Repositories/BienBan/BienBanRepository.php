<?php

namespace App\Repositories\BienBan;

use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Models\BienBanSHCN;
use App\Repositories\BienBan\BienBanRepositoryInterface;
use App\Models\Lop;
/**
 * The repository for Permission Model
 */
class BienBanRepository implements BienBanRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected $model;

    /**
     * @inheritdoc
     */
    public function __construct(BienBanSHCN $model)
    {
        $this->model = $model;
    }

    public function getByLopWithRelations(Lop $lop)
    {
        return BienBanSHCN::with(['lop', 'thuky.hoSo', 'tuan', 'gvcn'])
            ->where('id_lop', $lop->id)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($model, array $data)
    {
        $model->update($data);
        return $model;
    }
}