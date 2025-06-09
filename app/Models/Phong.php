<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\LoaiPhong;

class Phong extends Model
{
    //
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

}