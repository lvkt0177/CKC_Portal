<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\HocPhiStatus;
use App\Enum\LoaiDangKy;

class DangKyHGTL extends Model
{
    protected $table = 'dang_ky_hg_tl';

    protected $fillable = [
        'id_sinh_vien',
        'id_lop_hoc_phan',
        'so_tien',
        'loai_dong',
        'trang_thai',
    ];

    protected $casts = [
        'trang_thai' => HocPhiStatus::class,
        'loai_dong' => LoaiDangKy::class,
    ];

    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'id_sinh_vien');
    }

    public function lopHocPhan()
    {
        return $this->belongsTo(LopHocPhan::class, 'id_lop_hoc_phan');
    }
}
