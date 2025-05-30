<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Khoa;

class KhoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Khoa::insert([
            ["ten_khoa" => "Công Nghệ Thông Tin"],
            ["ten_khoa" => "Công Nghệ Nhiệt Lạnh"],
            ["ten_khoa" => "Cơ Khí"],
            ["ten_khoa" => "Cơ Khí Động Lực"],
            ["ten_khoa" => "Điện - Điện Tử"],
            ["ten_khoa" => "Kinh Tế"],
        ]);
    }
}