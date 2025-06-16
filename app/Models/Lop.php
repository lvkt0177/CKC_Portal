<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    protected $table = 'lop';
    protected $fillable = [
        'ten_lop',
        'id_nien_khoa',
        'id_gvcn',
        'id_nganh_hoc',
        'si_so'
    ];

    // Sinh Vien
    public function sinhViens()
    {
        return $this->hasMany(SinhVien::class, 'id_lop', 'id');
    }

    // Nien Khoa
    public function nienKhoa()
    {
        return $this->belongsTo(NienKhoa::class, 'id_nien_khoa', 'id');
    }

    // Biên Bản Sinh Hoạt Chủ Nhiệm
    public function bienBanSHCN()
    {
        return $this->hasMany(BienBanSHCN::class, 'id_lop', 'id');
    }
    public function giangVien()
    {
        return $this->belongsTo(User::class, 'id_gvcn', 'id');
    }
    public function lopHocPhans()
    {
        return $this->hasMany(LopHocPhan::class, 'id_lop', 'id');
    }
    // Nganh hoc
    public function nganhHoc()
    {
        return $this->belongsTo(NganhHoc::class, 'id_nganh_hoc', 'id');
    }
}