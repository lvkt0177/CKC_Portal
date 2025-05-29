<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoSo extends Model
{
    //
    protected $table = 'ho_so';

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'ngay_sinh',
        'gioi_tinh',
        'cccd',
        'dia_chi',
        'anh'
    ];

    // User 1-1 HoSo
    public function user()
    {
        return $this->hasOne(User::class, 'id_ho_so', 'id');
    }

    public function sinhVien()
    {
        return $this->hasOne(SinhVien::class, 'id_ho_so', 'id');
    }
}