<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NienKhoa;

class NienKhoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NienKhoa::insert([
            [
                "ten_nien_khoa" => "2022-2025",
                "nam_bat_dau" => 2022,
                "nam_ket_thuc" => 2025,
                "trang_thai" => 0
            ],
            [
                "ten_nien_khoa" => "2023-2026",
                "nam_bat_dau" => 2023,
                "nam_ket_thuc" => 2026,
                "trang_thai" => 0
            ],
        ]);
    }
}