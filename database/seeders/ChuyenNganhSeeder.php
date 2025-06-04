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
                'id_nganh_hoc' => 1,
                'ten_chuyen_nganh' => 'Lập trình Website',
                'trang_thai' => 0
            ],
            [
                'id_nganh_hoc' => 1,
                'ten_chuyen_nganh' => 'Lập trình Di động',
                'trang_thai' => 0
            ],
            [
                'id_nganh_hoc' => 1,
                'ten_chuyen_nganh' => 'Mạng máy tính',
                'trang_thai' => 0
            ],
        ]);
    }
}