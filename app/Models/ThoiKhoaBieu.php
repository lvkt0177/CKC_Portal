<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CastsIntegerIds;

class ThoiKhoaBieu extends Model
{
    use CastsIntegerIds;

    protected $table = "thoi_khoa_bieu";
    protected $fillable = [
        'id_tuan',
        'id_lop_hoc_phan',
        'id_phong',	
        'tiet_bat_dau',	
        'tiet_ket_thuc',
        'ngay',	
        ];
    //tuan
    public function tuan()
    {
        return $this->belongsTo(Tuan::class, 'id_tuan', 'id');
    }
    //lop hoc phan
    public function lopHocPhan()
    {
        return $this->belongsTo(LopHocPhan::class, 'id_lop_hoc_phan', 'id');
    }
    //phong
    public function phong()
    {
        return $this->belongsTo(Phong::class, 'id_phong', 'id');
    }
}