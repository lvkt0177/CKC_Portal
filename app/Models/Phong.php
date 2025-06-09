<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    //
    protected $table = 'phong';

    protected $fillable = [
        'ten',
        'so_luong',
        'loai_phong',
    ];
    //phieu_len_lop
    public function phieuLenLop()
    {
        return $this->hasMany(PhieuLenLop::class, 'id_phong', 'id');
    }

}