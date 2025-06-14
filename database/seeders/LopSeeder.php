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
            [
                "ten_lop" => "CDTH 22A",
                "id_nien_khoa" => 1,
                "id_gvcn" => 1,
                "id_nganh_hoc"=> 1,
                "si_so" => 0,
            ],
            [
                "ten_lop" => "CDTH 22B",
                "id_nien_khoa" => 1,
                "id_gvcn" => 2,
                "id_nganh_hoc"=> 1,
                "si_so" => 0,
            ],
            [
                "ten_lop" => "CDTH 23A",
                "id_nien_khoa" => 2,
                "id_gvcn" => 3,
                "id_nganh_hoc"=> 1,
                "si_so" => 0,
            ],
            [
                "ten_lop" => "CD DCN 23A",
                "id_nien_khoa" => 2,
                "id_gvcn" => 4,
                "id_nganh_hoc"=> 1,
                "si_so" => 0,
            ],
            [
                "ten_lop" => "CD DTCN 23A",
                "id_nien_khoa" => 2,
                "id_gvcn" => 5,
                "id_nganh_hoc"=> 1,
                "si_so" => 0,
            ],
        ]);

    }
}