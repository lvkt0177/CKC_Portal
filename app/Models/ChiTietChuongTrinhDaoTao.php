<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietChuongTrinhDaoTao extends Model
{
<<<<<<< HEAD
    protected $table = "chi_tiet_ctdt";
    protected $fillable = [
        'id_chuong_trinh_dao_tao',
        'id_mon_hoc',
        'id_bo_mon',
        'id_hoc_ky',
        'so_tiet',
        'so_tin_chi',
    ];
=======
        protected $table = "chi_tiet_ctdt";
        protected $fillable = [
            'id_chuong_trinh_dao_tao',
            'id_mon_hoc',
            'id_hoc_ky',
            'so_tiet',
            'so_tin_chi',
        ];
>>>>>>> origin/master
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