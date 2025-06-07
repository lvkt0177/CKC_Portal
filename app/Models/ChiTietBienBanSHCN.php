<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\LoaiVang;

class ChiTietBienBanSHCN extends Model
{
    //
    protected $table = 'chi_tiet_bien_ban_shcn';

    protected $fillable = [
        'id_bien_ban_shcn',
        'id_sinh_vien',
        'ly_do',
        'loai',
    ];

    protected $casts = [
        'loai' => LoaiVang::class,
    ];

    public function bienBanSHCN()
    {
        return $this->belongsTo(BienBanSHCN::class, 'id_bien_ban_shcn', 'id');
    }

    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'id_sinh_vien', 'id');
    }


}
