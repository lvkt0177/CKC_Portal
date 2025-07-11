<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\LoaiPhong;
use App\Traits\CastsIntegerIds;

class Phong extends Model
{
    use CastsIntegerIds;

    protected $table = 'phong';

    protected $fillable = [
        'ten',
        'so_luong',
        'loai_phong',
    ];

    protected $casts = [
        'loai_phong' => LoaiPhong::class,
    ];

    //phieu_len_lop
    public function phieuLenLop()
    {
        return $this->hasMany(PhieuLenLop::class, 'id_phong', 'id');
    }
    //thoi khoa bieu
    public function thoiKhoaBieu()
    {
        return $this->hasMany(ThoiKhoaBieu::class, 'id_phong', 'id');
    }
    public function lichThi()
    {
        return $this->hasMany(LichThi::class,'id_phong','id');
    }
}