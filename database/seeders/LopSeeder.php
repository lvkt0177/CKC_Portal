<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lop;
class LopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lop::insert([
            // Lớp thường - Khoá 22
            [
                "ten_lop" => "CD TH 22A",
                "id_nien_khoa" => 1,
                "id_gvcn" => 1,
                "id_chuyen_nganh"=> 1,
                "si_so" => 0,
            ],
            [
                "ten_lop" => "CD TH 22B",
                "id_nien_khoa" => 1,
                "id_gvcn" => 2,
                "id_chuyen_nganh"=> 1,
                "si_so" => 0,
            ],
            // Lớp thường - Khoá 23
            [
                "ten_lop" => "CD TH 23A",
                "id_nien_khoa" => 2,
                "id_gvcn" => 3,
                "id_chuyen_nganh"=> 1,
                "si_so" => 0,
            ],
            [
                "ten_lop" => "CD TH 23B",
                "id_nien_khoa" => 2,
                "id_gvcn" => 3,
                "id_chuyen_nganh"=> 1,
                "si_so" => 0,
            ],
            // Lớp thường - Khoá 24
            [
                "ten_lop" => "CD TH 24A",
                "id_nien_khoa" => 3,
                "id_gvcn" => 1,
                "id_chuyen_nganh"=> 1,
                "si_so" => 0,
            ],
            [
                "ten_lop" => "CD TH 24A",
                "id_nien_khoa" => 3,
                "id_gvcn" => 1,
                "id_chuyen_nganh"=> 1,
                "si_so" => 0,
            ],
            // Chuyên ngành - Khoá 22
            [
                "ten_lop" => "CD TH 22 WebC",
                "id_nien_khoa" => 1,
                "id_gvcn" => 1,
                "id_chuyen_nganh"=> 2,
                "si_so" => 0,
            ],
            [
                "ten_lop" => "CD TH 22 MMTA",
                "id_nien_khoa" => 1,
                "id_gvcn" => 1,
                "id_chuyen_nganh"=> 4,
                "si_so" => 0,
            ],
            [
                "ten_lop" => "CD TH 22 DĐB",
                "id_nien_khoa" => 1,
                "id_gvcn" => 1,
                "id_chuyen_nganh"=> 3,
                "si_so" => 0,
            ],
            // Chuyên ngành - Khoá 23
            [
                "ten_lop" => "CDTH 23 WebA",
                "id_nien_khoa" => 2,
                "id_gvcn" => 1,
                "id_chuyen_nganh"=> 2,
                "si_so" => 0,
            ],
            [
                "ten_lop" => "CDTH 23 MMTA",
                "id_nien_khoa" => 2,
                "id_gvcn" => 1,
                "id_chuyen_nganh"=> 4,
                "si_so" => 0,
            ],
            [
                "ten_lop" => "CDTH 23 DĐE",
                "id_nien_khoa" => 2,
                "id_gvcn" => 1,
                "id_chuyen_nganh"=> 3,
                "si_so" => 0,
            ],
        ]);

    }
}