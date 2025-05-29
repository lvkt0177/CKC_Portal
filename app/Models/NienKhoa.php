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
}