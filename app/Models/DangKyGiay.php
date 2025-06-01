<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DangKyGiay extends Model
{
    protected $table = "dang_ky_giay";
    protected $fillable = [
        'id_sinh_vien',
        'id_giang_vien',
        'id_giay',
        'ngay_dang_ky',
        'ngay_nhan',
        'trang_thai'
    ];
    public function loaiGiay()
    {
        return $this->belongsTo(LoaiGiay::class, 'id_loai_giay', 'id');
    }
    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'id_sinh_vien', 'id');
    }
    public function giangVien()
    {
        return $this->belongsTo(User::class, 'id_giang_vien', 'id');
    }
}