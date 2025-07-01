<?php

namespace Database\Seeders;

use App\Models\DanhSachHocPhan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanhSachHocPhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DanhSachHocPhan::insert([
            [
                "id_sinh_vien" => 1,
                "id_lop_hoc_phan" => 1,
                "diem_md_thuc_hanh" => null,
                "diem_md_ly_thuyet" => null,
                "diem_chuyen_can" => null,
                "diem_qua_trinh" => null,
                "diem_thi" => null,
                "diem_tong_ket" => null,
                "loai_hoc" => 0,
            ],
            [
                "id_sinh_vien" => 2,
                "id_lop_hoc_phan" => 1,
                "diem_md_thuc_hanh" => null,
                "diem_md_ly_thuyet" => null,
                "diem_chuyen_can" => null,
                "diem_qua_trinh" => null,
                "diem_thi" => null,
                "diem_tong_ket" => null,
                "loai_hoc" => 0,
            ],
            [
                "id_sinh_vien" => 3,
                "id_lop_hoc_phan" => 1,
                "diem_md_thuc_hanh" => null,
                "diem_md_ly_thuyet" => null,
                "diem_chuyen_can" => null,
                "diem_qua_trinh" => null,
                "diem_thi" => null,
                "diem_tong_ket" => null,
                "loai_hoc" => 0,
            ],
            [
                "id_sinh_vien" => 4,
                "id_lop_hoc_phan" => 1,
                "diem_md_thuc_hanh" => null,
                "diem_md_ly_thuyet" => null,
                "diem_chuyen_can" => null,
                "diem_qua_trinh" => null,
                "diem_thi" => null,
                "diem_tong_ket" => null,
                "loai_hoc" => 0,
            ],
            [
                "id_sinh_vien" => 5,
                "id_lop_hoc_phan" => 1,
                "diem_md_thuc_hanh" => null,
                "diem_md_ly_thuyet" => null,
                "diem_chuyen_can" => null,
                "diem_qua_trinh" => null,
                "diem_thi" => null,
                "diem_tong_ket" => null,
                "loai_hoc" => 0,
            ],
        ]);
    }
}