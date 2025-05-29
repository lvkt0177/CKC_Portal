<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    protected $table = 'sinhvien';

    protected $fillable = [
        'ma_sv',
        'id_lop',
        'id_ho_so',
        'id_nien_khoa',
        'chuc_vu',
        'mat_khau',
        'trang_thai'
    ];
}