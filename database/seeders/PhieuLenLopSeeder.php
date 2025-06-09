<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PhieuLenLop;

class PhieuLenLopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PhieuLenLop::insert([
            [
                'id_lop_hoc_phan' => 1,
                'id_phong' => 1,
                'id_tuan' => 1,
                'tiet_bat_dau' => 1,
                'so_tiet' => 3,
                'ngay' => "2025/6/2",
                'si_so' => 100,
                'hien_dien'=>100,
                'noi_dung'=>"Luật Lao Động"
            ],
            [
                'id_lop_hoc_phan' => 2,
                'id_phong' => 2,
                'id_tuan' => 1,
                'tiet_bat_dau' => 4,
                'so_tiet' => 3,
                'ngay' => "2025/6/2",
                'si_so' => 100,
                'hien_dien'=>100,
                'noi_dung'=>"Luật Lao Động"
            ],
            //Thu khac
            [
                'id_lop_hoc_phan' => 2,
                'id_phong' => 2,
                'id_tuan' => 1,
                'tiet_bat_dau' => 4,
                'so_tiet' => 3,
                'ngay' => "2025/6/5",
                'si_so' => 100,
                'hien_dien'=>100,
                'noi_dung'=>"Luật Lao Động"
            ],
            //Buoi chieu
            [
                'id_lop_hoc_phan' => 2,
                'id_phong' => 2,
                'id_tuan' => 1,
                'tiet_bat_dau' => 7,
                'so_tiet' => 3,
                'ngay' => "2025/6/5",
                'si_so' => 100,
                'hien_dien'=>100,
                'noi_dung'=>"Luật Lao Động"
            ],
            //Buoi Toi
            [
                'id_lop_hoc_phan' => 2,
                'id_phong' => 2,
                'id_tuan' => 1,
                'tiet_bat_dau' => 13,
                'so_tiet' => 2,
                'ngay' => "2025/6/6",
                'si_so' => 100,
                'hien_dien'=>100,
                'noi_dung'=>"Luật Lao Động"
            ],
        ]);
    }
}