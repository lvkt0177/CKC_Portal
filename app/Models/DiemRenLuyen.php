<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\XepLoaiDRL;

class DiemRenLuyen extends Model
{
    protected $table = "diem_ren_luyen";
    protected $fillable = [
        "id_gvcn",
        "id_sinh_vien",
        "id_thang",
        "xep_loai",
        'thoi_gian',
    ];
    protected $casts = [
        'xep_loai' => XepLoaiDRL::class
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