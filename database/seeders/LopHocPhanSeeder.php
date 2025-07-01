<?php

namespace Database\Seeders;

use App\Models\LopHocPhan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LopHocPhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LopHocPhan::insert([
            [
                "ten_hoc_phan" => "Pháp luật",
                "id_giang_vien" => 1,
                "id_chuong_trinh_dao_tao" => 1,
                "id_lop" => 1,
                "loai_lop_hoc_phan" => 0,
                "so_luong_sinh_vien" => 100,
                "loai_mon" => 0,
                "trang_thai" => 0,
            ],
            [
                "ten_hoc_phan" => "Pháp luật",
                "id_giang_vien" => 1,
                "id_chuong_trinh_dao_tao" => 1,
                "id_lop" => 2,
                "loai_lop_hoc_phan" => 0,
                "so_luong_sinh_vien" => 100,
                "loai_mon" => 0,
                "trang_thai" => 0,
            ],
        ]);
    }
}