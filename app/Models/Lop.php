<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
    public function sinhViens(): MorphMany
    {
        return $this->morphMany(SinhVien::class, 'lop');
    }
    //Bien Ban
    public function bienBan(): MorphMany
    {
        return $this->morphMany(BienBan::class, 'lop');
    }
    //LopHocPhan
    public function lopHocPhan(): MorphMany
    {
        return $this->morphMany(LopHocPhan::class, 'lop');
    }
    // Nien Khoa
    public function nienKhoa()
    {
        return $this->belongsTo(NienKhoa::class, 'id_nien_khoa', 'id');
    }

    public function giangVien()
    {
        return $this->belongsTo(User::class, 'id_gvcn', 'id');
    }
  
    // Nganh hoc
    public function nganhHoc()
    {
        return $this->belongsTo(NganhHoc::class, 'id_nganh_hoc', 'id');
    }
}