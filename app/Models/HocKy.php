<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CastsIntegerIds;

class HocKy extends Model
{
    use CastsIntegerIds;

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

    public function hocPhi()
    {
        return $this->hasMany(HocPhi::class, 'id_hoc_ky', 'id');
    }

    public function chiTietChuongTrinhDaoTaos()
    {
        return $this->hasMany(ChiTietChuongTrinhDaoTao::class, 'id_hoc_ky', 'id');
    }
}