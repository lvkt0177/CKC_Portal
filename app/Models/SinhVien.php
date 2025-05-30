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
        'chuc_vu',
        'mat_khau',
        'trang_thai'
    ];

    public function hoSo()
    {
        return $this->belongsTo(HoSo::class, 'id_ho_so', 'id');
    }

    //Lớp 1 - N
    public function lop()
    {
        return $this->belongsTo(Lop::class, 'id_lop', 'id');
    }
    
}