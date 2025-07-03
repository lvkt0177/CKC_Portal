<?php

namespace App\Repositories\BienBan;

use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Models\BienBanSHCN;
use App\Repositories\BienBan\BienBanRepositoryInterface;
use App\Models\Lop;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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

    public function getByLopWithRelations(Model $lop)
    {
        if (!($lop instanceof \App\Models\Lop || $lop instanceof \App\Models\LopChuyenNganh)) {
            throw new \InvalidArgumentException('Lỗi');
        }

        return BienBanSHCN::with(['lop', 'thuky.hoSo', 'tuan', 'gvcn'])
            ->where('lop_type', get_class($lop))
            ->where('lop_id', $lop->id)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getByLopWithRelationsByIdLop($lop_id, $perPage = 10)
    {
        return BienBanSHCN::with(['lop', 'thuky.hoSo', 'tuan', 'gvcn.hoSo'])
            ->where('lop_id', $lop_id)
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
        $model->update($data);
        return $model;
    }
}