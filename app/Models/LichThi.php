<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichThi extends Model
{
    //
    protected $table = "lich_thi";
    protected $fillable = [
        'id_lop_hoc_phan',
        'id_giam_thi_1',	
        'id_giam_thi_2',
        'id_tuan',
        'id_phong_thi',
        'ngay_thi',
        'gio_bat_dau',	
        'thoi_gian_thi',
        'lan_thi',	
        'trang_thai'
        ];
    
    public function lopHocPhan()
    {
        return $this->belongsTo(LopHocPhan::class, 'id_lop_hoc_phan', 'id');
    }
    public function phong()
    {
        return $this->belongsTo(Phong::class, 'id_phong_thi', 'id');
    }
    public function giamThi1()
    {
        return $this->belongsTo(User::class, 'id_giam_thi_1');
    }
    public function giamThi2()
    {
        return $this->belongsTo(User::class, 'id_giam_thi_2');
    }
    public function tuan()
    {
        return $this->belongsTo(Tuan::class, 'id_tuan', 'id');
    }
}