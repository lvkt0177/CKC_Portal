<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\BienBanStatus;
use App\Traits\CastsIntegerIds;

class BienBanSHCN extends Model
{
    use CastsIntegerIds;
    
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
    ];

    protected $casts = [
        'trang_thai' => BienBanStatus::class,
        'thoi_gian_bat_dau' => 'datetime',
        'thoi_gian_ket_thuc' => 'datetime',
    ];

    public function lop()
    {
        return $this->belongsTo(Lop::class, 'id_lop', 'id');
    }

    public function tuan()
    {
        return $this->belongsTo(Tuan::class, 'id_tuan', 'id');
    }

    public function gvcn()
    {
        return $this->belongsTo(User::class, 'id_gvcn', 'id');
    }

    public function thuky()
    {
        return $this->belongsTo(SinhVien::class, 'id_sv', 'id');
    }

    public function chiTietBienBanSHCN()
    {
        return $this->hasMany(ChiTietBienBanSHCN::class, 'id_bien_ban_shcn', 'id');
    }
    
}
