<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
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