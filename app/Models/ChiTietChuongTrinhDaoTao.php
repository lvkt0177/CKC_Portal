<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CastsIntegerIds;

class ChiTietChuongTrinhDaoTao extends Model
{
    use CastsIntegerIds;

    protected $table = "chi_tiet_ctdt";
    protected $fillable = [
        'id_chuong_trinh_dao_tao',
        'id_mon_hoc',
        'id_hoc_ky',
        'so_tiet',
        'so_tin_chi',
    ];
    public function chuongTrinhDaoTao()
    {
        return $this->belongsTo(ChuongTrinhDaoTao::class, 'id_chuong_trinh_dao_tao', 'id');
    }
    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'id_mon_hoc', 'id');
    }
    //hocKy
    public function hocKy()
    {
        return $this->belongsTo(HocKy::class, 'id_hoc_ky', 'id');
    }
}