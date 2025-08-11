<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\ThongBaoStatus;
use App\Enum\CapTren;
use App\Traits\CastsIntegerIds;

class ThongBao extends Model
{
    use CastsIntegerIds;

    protected $table = 'thong_bao';
    
    protected $fillable = [
        'id_gv',
        'tu_ai',
        'ngay_gui',
        'tieu_de',
        'noi_dung',
        'trang_thai',
    ];

    protected $casts = [
        'ngay_gui' => 'date',
        'trang_thai' => ThongBaoStatus::class,
    ];

    public function file()
    {
        return $this->hasMany(File::class, 'id_thong_bao', 'id');
    }

    public function giangVien()
    {
        return $this->belongsTo(User::class, 'id_gv', 'id');
    }

    public function chiTietThongBao()
    {
        return $this->hasMany(ChiTietThongBao::class, 'id_thong_bao', 'id');
    }

    public function binhLuans()
    {
        return $this->hasMany(BinhLuan::class, 'id_thong_bao','id');
    }
}
