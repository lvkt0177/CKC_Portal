<?php

namespace App\Repositories\ChiTietBienBan;

use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Models\ChiTietBienBanSHCN;
use App\Repositories\ChiTietBienBan\ChiTietBienBanRepositoryInterface;

/**
 * The repository for Permission Model
 */
class ChiTietBienBanRepository extends BaseRepository implements ChiTietBienBanRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected $model;

    /**
     * @inheritdoc
     */
    public function __construct(ChiTietBienBanSHCN $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    public function updateOrCreate(array $condition, array $data)
    {
        $record = $this->model->where($condition)->first();

        if ($record) {
            $record->update($data);
            return $record;
        }

        return $this->model->create(array_merge($condition, $data));
    }

    
}
