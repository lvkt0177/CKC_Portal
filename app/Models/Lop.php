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
        'id_chuyen_nganh',
        'si_so'
    ];

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
    public function chuyenNganh()
    {
        return $this->belongsTo(ChuyenNganh::class, 'id_chuyen_nganh', 'id');
    }
    // Danh sach lop
    public function danhSachLop()
    {
        return $this->hasMany(DanhSachLop::class, 'id_lop', 'id');
    }
}