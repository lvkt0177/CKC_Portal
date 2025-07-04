<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BoMon;

class BoMonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BoMon::insert([
            [
                "id_chuyen_nganh" => 1,
                "ten_bo_mon" => "Tin Học Phần Cứng",
            ],
            [
                "id_chuyen_nganh" => 1,
                "ten_bo_mon" => "Tin Học Phần Mềm",
            ],
            [
                "id_chuyen_nganh" => 2,
                "ten_bo_mon" => "CNKT Điện công nghiệp",
            ],
            [
                "id_chuyen_nganh" => 2,
                "ten_bo_mon" => "CNKT Điện tử công nghiệp",
            ],
        ]);
    }
}