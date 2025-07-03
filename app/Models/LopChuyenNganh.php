<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class LopChuyenNganh extends Model
{
    //
    protected $table = 'lop_chuyen_nganh';

    protected $fillable = [
        'ten_lop',
        'id_nien_khoa',
        'id_gvcn',
        'id_chuyen_nganh',
        'si_so',
    ];

    //Sinh viên
    public function sinhViens(): MorphMany
    {
        return $this->morphMany(SinhVien::class, 'lop');
    }
    //Bien ban
    public function bienBan(): MorphMany
    {
        return $this->morphMany(BienBan::class, 'lop');
    }
    //LopHocPhan
    public function lopHocPhan(): MorphMany
    {
        return $this->morphMany(LopHocPhan::class, 'lop');
    }
    //nienkhoa
    public function nienKhoa()
    {
        return $this->belongsTo(NienKhoa::class, 'id_nien_khoa');
    }
    //giangvien
    public function giangVien()
    {
        return $this->belongsTo(User::class, 'id_gvcn');
    }
    //chuyennganh
    public function chuyenNganh()
    {
        return $this->belongsTo(ChuyenNganh::class, 'id_chuyen_nganh');
    }

}