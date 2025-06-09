<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiemRenLuyen extends Model
{
    protected $table = "diem_ren_luyen";
    protected $fillable = [
        "id_gvcn",
        "id_sinh_vien",
        "xep_loai",
        'thoi_gian',
    ];
    //sinhvien
    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'id_sinh_vien', 'id');
    }
    //giaovienchunhiem
    public function giaoVienChuNhiem()
    {
        return $this->belongsTo(User::class, 'id_gvcn', 'id');
    }

}