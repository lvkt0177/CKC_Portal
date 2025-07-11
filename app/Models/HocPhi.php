<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\HocPhiStatus;
use App\Traits\CastsIntegerIds;

class HocPhi extends Model
{
    use CastsIntegerIds;

    protected $table = 'hoc_phi';

    protected $fillable = [
        'id_hoc_ky',
        'id_sinh_vien',
        'tong_tien',
        'trang_thai',
        'ngay_dong',
    ];

    protected $casts = [
        'trang_thai' => HocPhiStatus::class,
        'ngay_dong' => 'datetime',
    ];

    public function hocKy()
    {
        return $this->belongsTo(HocKy::class, 'id_hoc_ky');
    }

    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'id_sinh_vien');
    }

}
