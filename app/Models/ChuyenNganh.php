<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChuyenNganh extends Model
{
    protected $table = "chuyen_nganh";
    
    protected $fillable = [
        'ten_chuyen_nganh',
        'id_khoa',
        'id_chuyen_nganh_cha',
        'trang_thai'
    ];

    public function chuongTrinhDaoTao()
    {
        return $this->hasMany(ChuongTrinhDaoTao::class, 'id_chuyen_nganh', 'id');
    }
    
    public function chuyenNganhCha(): BelongsTo
    {
        return $this->belongsTo(ChuyenNganh::class, 'id_chuyen_nganh_cha');
    }

    public function chuyenNganhCon()
    {
        return $this->hasMany(ChuyenNganh::class, 'id_chuyen_nganh_cha');
    }

    //Khoa
    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'id_khoa');
    }
}