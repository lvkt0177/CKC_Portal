<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\Gender;
use App\Traits\CastsIntegerIds;

class HoSo extends Model
{
    use CastsIntegerIds;

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

    protected $casts = [
        'gioi_tinh' => Gender::class,
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