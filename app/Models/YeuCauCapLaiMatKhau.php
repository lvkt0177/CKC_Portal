<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\LoaiTaiKhoan;
use App\Enum\TrangThaiYeuCau;
use App\Traits\CastsIntegerIds;

class YeuCauCapLaiMatKhau extends Model
{
    use CastsIntegerIds;

    protected $table = 'yeu_cau_cap_lai_mat_khau';

    protected $fillable = [
        'id_sinh_vien',
        'id_giang_vien',
        'loai',
        'trang_thai',
    ];

    protected $casts = [
        'loai' => LoaiTaiKhoan::class,
        'trang_thai' => TrangThaiYeuCau::class
    ];

    public function sinhvien()
    {
        return $this->belongsTo(SinhVien::class, 'id_sinh_vien');
    }

    public function giangvien()
    {
        return $this->belongsTo(User::class, 'id_giang_vien');
    }
}
