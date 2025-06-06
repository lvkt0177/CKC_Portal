<?php

namespace Database\Seeders;

use App\Models\HocKy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HocKySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HocKy::insert([
            [
                "id_nien_khoa" => 1,
                "ten_hoc_ky" => "Học kỳ 1",
                "ngay_bat_dau" => "2022-08-05",
                "ngay_ket_thuc" => "2022-12-15",
            ],
            [
                "id_nien_khoa" => 1,
                "ten_hoc_ky" => "Học kỳ 2",
                "ngay_bat_dau" => "2023-01-05",
                "ngay_ket_thuc" => "2023-05-20",
            ],
            [
                "id_nien_khoa" => 1,
                "ten_hoc_ky" => "Học kỳ 3",
                "ngay_bat_dau" => "2023-06-01",
                "ngay_ket_thuc" => "2023-08-15",
            ],
            [
                "id_nien_khoa" => 1,
                "ten_hoc_ky" => "Học kỳ 4",
                "ngay_bat_dau" => "2023-08-25",
                "ngay_ket_thuc" => "2023-12-10",
            ],
            [
                "id_nien_khoa" => 1,
                "ten_hoc_ky" => "Học kỳ 5",
                "ngay_bat_dau" => "2024-01-05",
                "ngay_ket_thuc" => "2024-05-15",
            ],
            [
                "id_nien_khoa" => 1,
                "ten_hoc_ky" => "Học kỳ 6",
                "ngay_bat_dau" => "2024-06-01",
                "ngay_ket_thuc" => "2024-08-10",
            ],
        ]);
    }
}