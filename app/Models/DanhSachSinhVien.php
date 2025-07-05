<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\RoleStudent;
use Spatie\Permission\Traits\HasPermissions;
use Laravel\Sanctum\HasApiTokens;

class DanhSachSinhVien extends Model
{
    use HasApiTokens, HasPermissions;

    protected $table = "danh_sach_sinh_vien";
    protected $fillable = [
        'id_lop',
        'id_sinh_vien',
        'chuc_vu',
    ];

    protected $casts = [
        'chuc_vu' => RoleStudent::class
    ];
    // lop
    public function lop()
    {
        return $this->belongsTo(Lop::class, 'id_lop', 'id');
    }

    // sinh vien
    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'id_sinh_vien', 'id');
    }
}
