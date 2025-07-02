<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\RoleStudent;
use App\Enum\ActiveOrNotStatus;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Permission\Traits\HasPermissions;

class SinhVien extends Authenticatable 
{
    use HasApiTokens, HasPermissions;
    protected $table = 'sinhvien';

    protected $fillable = [
        'ma_sv',
        'id_lop',
        'id_ho_so',
        'chuc_vu',
        'password',
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

    public function binhLuans()
    {
        return $this->morphMany(BinhLuan::class, 'nguoi_binh_luan','id');
    }

    public function capMatKhau()
    {
        return $this->hasMany(YeuCauCapLaiMatKhau::class, 'id_sinh_vien', 'id');
    }
    //lopchuyennganh
    public function lopChuyenNganh()
    {
        return $this->belongsTo(LopChuyenNganh::class, 'id_lop_chuyen_nganh', 'id');
    }

    public function hocPhi()
    {
        return $this->hasMany(HocPhi::class, 'id_sinh_vien', 'id');
    }

    public function dangKyHocGhepThiLai()
    {
        return $this->hasMany(DangKyHGTL::class, 'id_sinh_vien', 'id');
    }

}