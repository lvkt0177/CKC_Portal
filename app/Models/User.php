<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\CastsIntegerIds;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens, CastsIntegerIds;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_ho_so',
        'id_bo_mon',
        'tai_khoan',
        'password',
        'trang_thai',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasPermission(string $permission): bool
    {
        return $this->role === $permission;
    }


    // Ho So
    public function hoSo()
    {
        return $this->belongsTo(HoSo::class, 'id_ho_so', 'id');
    }
    // Bo Mon
    public function boMon()
    {
        return $this->belongsTo(BoMon::class, 'id_bo_mon', 'id');
    }
    public function lopChuNhiem()
    {
        return $this->hasOne(User::class, 'id_gvcn', 'id');
    }
    public function dangKyGiay()
    {
        return $this->hasMany(DangKyGiay::class, 'id_giang_vien', 'id');
    }

    public function lopHocPhans()
    {
        return $this->hasMany(LopHocPhan::class, 'id_giang_vien', 'id');
    }

    public function bienBanSHCN()
    {
        return $this->hasMany(BienBanSHCN::class, 'id_gvcn', 'id');
    }
    //DiemRenLuyen
    public function diemRenLuyens()
    {
        return $this->hasMany(DiemRenLuyen::class, 'id_giang_vien', 'id');
    }

    public function binhLuans()
    {
        return $this->morphMany(BinhLuan::class, 'nguoi_binh_luan');
    }

    public function capMatKhau()
    {
        return $this->hasMany(YeuCauCapLaiMatKhau::class, 'id_giang_vien', 'id');
    }
 
    public function lichThi()
    {
        return $this->hasMany(LichThi::class,'id_giam_thi_','id');
    }
}