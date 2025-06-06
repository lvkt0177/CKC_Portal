<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NienKhoa extends Model
{
    protected $table = 'nien_khoa';
    protected $fillable = [
        'ten_nien_khoa',
        'nam_bat_dau',
        'nam_ket_thuc',
        'trang_thai'
    ];

    // Lớp 1 - N
    public function lops()
    {
        return $this->hasMany(Lop::class, 'id_nien_khoa', 'id');
    }
    // Hoc Ky 1 - N
    public function hocKys()
    {
        return $this->hasMany(HocKy::class, 'id_nien_khoa', 'id');
    }
}