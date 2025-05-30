<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BienBanSHCN extends Model
{
    //
    protected $table = 'bien_ban_shcn';

    
    protected $fillable = [
        'id_lop',
        'id_gvcn',
        'id_sv',
        'id_tuan',
        'tieu_de',
        'noi_dung',
        'ngay_bat_dau',
        'tuan',
        'nam_hoc',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        'so_luong_sinh_vien',
        'vang_mat',
        'trang_thai',
        'created_at',
        'updated_at'
    ];

    public function lop()
    {
        return $this->belongsTo(Lop::class, 'id_lop', 'id');
    }
    
}
