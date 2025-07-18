<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\LoaiMonHoc;
use App\Enum\NopBangDiemStatus;
use App\Enum\ActiveOrNotStatus;
use App\Traits\CastsIntegerIds;

class LopHocPhan extends Model
{
    use CastsIntegerIds;

    protected $table = "lop_hoc_phan";
    protected $fillable = [
        'ten_hoc_phan',
        'id_giang_vien',
        'id_chuong_trinh_dao_tao',
        'id_lop',
        'loai_lop_hoc_phan',
        'so_luong_sinh_vien',
        'loai_mon',
        'gioi_han_dang_ky',
        'trang_thai',
        'trang_thai_nop_bang_diem'
    ];
    protected $casts = [
        'loai_mon' => LoaiMonHoc::class,
        'trang_thai_nop_bang_diem' => NopBangDiemStatus::class,
    ];
    public function giangVien()
    {
        return $this->belongsTo(User::class, 'id_giang_vien', 'id');
    }

    public function lop()
    {
        return $this->belongsTo(Lop::class, 'id_lop', 'id');
    }
    public function chuongTrinhDaoTao()
    {
        return $this->belongsTo(ChuongTrinhDaoTao::class, 'id_chuong_trinh_dao_tao', 'id');
    }
    //danhsachhocphan
    public function danhSachHocPhan()
    {
        return $this->hasMany(DanhSachHocPhan::class, 'id_lop_hoc_phan', 'id');
    }
    //phieu_len_lop
    public function phieuLenLop()
    {
        return $this->hasMany(PhieuLenLop::class, 'id_lop_hoc_phan', 'id');
    }
    //thoi khoa bieu
    public function thoiKhoaBieu()
    {
        return $this->hasMany(ThoiKhoaBieu::class, 'id_lop_hoc_phan', 'id');
    }

    public function lichThi()
    {
        return $this->hasMany(LichThi::class,'id_lop_hoc_phan','id');

    }
    //dang ky hoc ghep
    public function dangKyHocGhepThiLai()
    {
        return $this->hasOne(DangKyHGTL::class, 'id_lop_hoc_phan', 'id');
    }
}