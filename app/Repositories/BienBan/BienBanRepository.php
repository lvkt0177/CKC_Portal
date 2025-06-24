<?php

namespace App\Repositories\BienBan;

use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Models\BienBanSHCN;
use App\Repositories\BienBan\BienBanRepositoryInterface;
use App\Models\Lop;
use App\Models\User;
use App\Enum\BienBanStatus;
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

    public function getByLopWithRelationsByIdLop($id_lop, $perPage = 10)
    {
        return BienBanSHCN::with(['lop', 'thuky.hoSo', 'tuan', 'gvcn.hoSo'])
            ->where('id_lop', $id_lop)
            ->where('trang_thai', BienBanStatus::ACTIVE)
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($model, array $data)
    {
        if($data['trang_thai'] == BienBanStatus::ACTIVE){
            return false;
        }
        $model->update($data);
        return $model;
    }
}