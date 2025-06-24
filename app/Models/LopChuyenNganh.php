<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    //sinhviens
    public function sinhViens()
    {
        return $this->hasMany(SinhVien::class, 'id_lop', 'id');
    }

}