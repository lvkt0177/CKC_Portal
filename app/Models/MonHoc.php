<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CastsIntegerIds;

class MonHoc extends Model
{
    use CastsIntegerIds;

    protected $table = "mon_hoc";
    protected $fillable = [
        'ten_mon',
        'loai_mon_hoc'
    ];
    public function chiTietChuongTrinhDaoTaos()
    {
        return $this->hasMany(ChiTietChuongTrinhDaoTao::class, 'id_mon_hoc', 'id');
    }
}