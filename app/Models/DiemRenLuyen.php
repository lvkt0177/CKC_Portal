<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\XepLoaiDRL;
use App\Traits\CastsIntegerIds;


class DiemRenLuyen extends Model
{
    use CastsIntegerIds;

    protected $table = "diem_ren_luyen";
    protected $fillable = [
        "id_gvcn",
        "id_sinh_vien",
        "id_nam",
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
    //nam
    public function nam()
    {
        return $this->belongsTo(Nam::class, 'id_nam', 'id');
    }
}