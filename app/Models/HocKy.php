<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HocKy extends Model
{
    protected $table = "hoc_ky";
    protected $fillable = [
        'id_nien_khoa',
        'ten_hoc_ky',
        'ngay_bat_dau',
        'ngay_ket_thuc',
    ];
    public function nienKhoa()
    {
        return $this->belongsTo(NienKhoa::class, 'id_nien_khoa', 'id');
    }
}