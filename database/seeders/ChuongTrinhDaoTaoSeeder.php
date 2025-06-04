<?php

namespace Database\Seeders;

use App\Models\ChuongTrinhDaoTao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChuongTrinhDaoTaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChuongTrinhDaoTao::insert([
            [
                'id_chuyen_nganh' => 1,
                'ten_chuong_trinh_dao_tao' => 'Chương trình đào tạo Lập trình Website',
                'tong_tin_chi' => 153,
                'thoi_gian' => 3,
            ],
            [
                'id_chuyen_nganh' => 2,
                'ten_chuong_trinh_dao_tao' => 'Chương trình đào tạo Lập trình Di động',
                'tong_tin_chi' => 150,
                'thoi_gian' => 3,
            ],
            [
                'id_chuyen_nganh' => 3,
                'ten_chuong_trinh_dao_tao' => 'Chương trình đào tạo Mạng máy tính',
                'tong_tin_chi' => 160,
                'thoi_gian' => 3,
            ],

        ]);
    }
}