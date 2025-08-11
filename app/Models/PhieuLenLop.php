<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CastsIntegerIds;

class PhieuLenLop extends Model
{
    use CastsIntegerIds;

    protected $table = 'phieu_len_lop';
    protected $fillable  =[
        'id_lop_hoc_phan',
        'id_phong',
        'id_tuan',
        'tiet_bat_dau',
        'so_tiet',
        'ngay',
        'si_so',
        'hien_dien',
        'noi_dung',
        ];
    
    //lop hoc phan
    public function lopHocPhan()
    {
        return $this->belongsTo(LopHocPhan::class, 'id_lop_hoc_phan', 'id');
    }
    // phong
    public function phong()
    {
        return $this->belongsTo(Phong::class, 'id_phong', 'id');
    }
    //tuan
    public function tuan()
    {
        return $this->belongsTo(Tuan::class, 'id_tuan', 'id');
    }
}