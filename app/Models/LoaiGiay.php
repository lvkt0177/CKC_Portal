<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CastsIntegerIds;

class LoaiGiay extends Model
{
    use CastsIntegerIds;

    protected $table = "loai_giay";
    protected $fillable = [
        'ten_giay',
        'trang_thai'
    ];
    public function dangKyGiay()
    {
        return $this->hasMany(DangKyGiay::class, 'id_loai_giay', 'id');
    }
}