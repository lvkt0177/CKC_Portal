<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CastsIntegerIds;

class ChuongTrinhDaoTao extends Model
{
    use CastsIntegerIds;

    protected $table = "chuong_trinh_dao_tao";
    protected $fillable = [
        'id_chuyen_nganh',
        'ten_chuong_trinh_dao_tao',
        'tong_tin_chi',
        'trang_thai',
        'thoi_gian',
    ];

    public function chuyenNganh()
    {
        return $this->belongsTo(ChuyenNganh::class, 'id_chuyen_nganh');
    }

    public function chiTietChuongTrinhDaoTao()
    {
        return $this->hasMany(ChiTietChuongTrinhDaoTao::class, 'id_chuong_trinh_dao_tao', 'id');
    }
    public function lopHocPhans()
    {
        return $this->hasMany(LopHocPhan::class, 'id_chuong_trinh_dao_tao', 'id');
    }
}