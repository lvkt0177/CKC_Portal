<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\DocThongBao;

class ChiTietThongBao extends Model
{
    //
    protected $table = 'chi_tiet_thong_bao';

    protected $fillable = [
        'id_thong_bao',
        'id_sinh_vien',
        'trang_thai',
    ];

    protected $casts = [
        'trang_thai' => DocThongBao::class
    ];

    public function thongBao()
    {
        return $this->belongsTo(ThongBao::class, 'id_thong_bao', 'id');
    }

    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'id_sinh_vien', 'id');
    }
}
