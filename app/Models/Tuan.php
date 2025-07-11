<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CastsIntegerIds;

class Tuan extends Model
{
    use CastsIntegerIds;

    protected $table = 'tuan';

    protected $fillable = [
        'id_nam',
        'tuan',
        'ngay_bat_dau',
        'ngay_ket_thuc',
    ];
    protected $casts = [
    'ngay_bat_dau' => 'date',
    'ngay_ket_thuc' => 'date',
];
    //phieu len lop
    public function phieuLenLop()
    {
        return $this->hasMany(PhieuLenLop::class, 'id_tuan', 'id');
    }
    //nam
    public function nam()
    {
        return $this->belongsTo(Nam::class, 'id_nam', 'id');
    }
    //thoi khoa bieu
    public function thoiKhoaBieu()
    {
        return $this->hasMany(ThoiKhoaBieu::class, 'id_tuan', 'id');
    }

    //lich thi
    public function lichThi()
    {
        return $this->hasMany(LichThi::class, 'id_tuan', 'id');
    }
}