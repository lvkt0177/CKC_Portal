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
                "id_nganh_hoc" => 1,
                "ten_bo_mon" => "Tin Học Phần Cứng",
            ],
            [
                "id_nganh_hoc" => 1,
                "ten_bo_mon" => "Tin Học Phần Mềm",
            ],
        ]);
    }
}