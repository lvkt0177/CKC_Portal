<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChuyenNganh extends Model
{
    protected $table = "chuyen_nganh";
    protected $fillable = [
        'ten_chuyen_nganh',
        'id_nganh_hoc',
        'trang_thai'
    ];

    public function chuongTrinhDaoTao()
    {
        return $this->hasMany(ChuongTrinhDaoTao::class, 'id_chuyen_nganh', 'id');
    }
    public function nganhHoc()
    {
        return $this->belongsTo(NganhHoc::class, 'id_nganh_hoc', 'id');
    }
}