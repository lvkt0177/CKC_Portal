<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\RoleStudent;
use App\Enum\ActiveOrNotStatus;
use Illuminate\Foundation\Auth\User as Authenticatable;
class SinhVien extends Authenticatable 
{
    protected $table = 'sinhvien';

    protected $fillable = [
        'ma_sv',
        'id_lop',
        'id_ho_so',
        'chuc_vu',
        'mat_khau',
        'trang_thai'
    ];

    protected $casts = [
        'chuc_vu' => RoleStudent::class,
        'trang_thai' => ActiveOrNotStatus::class

    ];

    public function hoSo()
    {
        return $this->belongsTo(HoSo::class, 'id_ho_so', 'id');
    }

    //Lớp 1 - N
    public function lop()
    {
        return $this->belongsTo(Lop::class, 'id_lop', 'id');
    }
    public function dangKyGiay()
    {
        return $this->hasMany(DangKyGiay::class, 'id_sinh_vien', 'id');
    }
    //danhsachhocphan
    public function danhSachHocPhans()
    {
        return $this->hasMany(DanhSachHocPhan::class, 'id_sinh_vien', 'id');
    }

    public function diemRenLuyens()
    {
        return $this->hasMany(DiemRenLuyen::class, 'id_sinh_vien', 'id');
    }

    public function chiTietBienBanSHCN()
    {
        return $this->hasMany(ChiTietBienBanSHCN::class, 'id_sinh_vien', 'id');
    }

    public function chiTietThongBao()
    {
        return $this->hasMany(ChiTietThongBao::class, 'id_sinh_vien', 'id');
    }

}