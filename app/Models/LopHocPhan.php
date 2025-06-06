<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LopHocPhan extends Model
{
    protected $table = "lop_hoc_phan";
    protected $fillable = [
        'ten_hoc_phan',
        'id_giang_vien',
        'id_chuong_trinh_dao_tao',
        'id_lop',
        'loai_lop_hoc_phan',
        'so_luong_dang_ky',
        'loai_mon',
        'trang_thai',
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
}