<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhSachHocPhan extends Model
{
    protected $table = "danh_sach_hoc_phan";
    protected $fillable = [
        'id_sinh_vien',
        'id_lop_hoc_phan',
        'diem_md_thuc_hanh',
        'diem_md_ly_thuyet',
        'diem_chuyen_can',
        'diem_qua_trinh',
        'diem_thi_lan_1',
        'diem_thi_lan_2',
        'diem_tong_ket',
        'loai_hoc',
    ];
    public $incrementing = false;
    protected $primaryKey = null;
    //lop hoc phan
    public function lopHocPhan()
    {
        return $this->belongsTo(LopHocPhan::class, 'id_lop_hoc_phan', 'id');
    }
    //sinhvien
    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'id_sinh_vien', 'id');
    }
}