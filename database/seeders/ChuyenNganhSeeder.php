<?php

namespace Database\Seeders;

use App\Models\ChuyenNganh;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChuyenNganhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChuyenNganh::insert([
            [
                'ten_chuyen_nganh' => 'Công nghệ thông tin',
                'id_khoa' => 1,
                'id_chuyen_nganh_cha' => null,
                'trang_thai' => 0
            ],
            [
                'ten_chuyen_nganh' => 'Lập trình Website',
                'id_khoa' => 1,
                'id_chuyen_nganh_cha' => 1,
                'trang_thai' => 0
            ],
            [
                'ten_chuyen_nganh' => 'Lập trình Di động',
                'id_khoa' => 1,
                'id_chuyen_nganh_cha' => 1,
                'trang_thai' => 0
            ],
            [
                'ten_chuyen_nganh' => 'Mạng máy tính',
                'id_khoa' => 1,
                'id_chuyen_nganh_cha' => 1,
                'trang_thai' => 0
            ],
        ]);
    }
}