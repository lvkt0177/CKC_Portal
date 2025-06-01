<?php

namespace Database\Seeders;

use App\Models\DangKyGiay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DangKytGiaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DangKyGiay::insert([
            [
                "id_sinh_vien" => "1",
                "id_giang_vien" => 1,
                "id_loai_giay" => 1,
                "ngay_dang_ky" => now()->format("Y-m-d"),
                "ngay_nhan" => '2025-06-10',
                "trang_thai" => 1,
            ],
            [
                "id_sinh_vien" => "1",
                "id_giang_vien" => null,
                "id_loai_giay" => 1,
                "ngay_dang_ky" => now()->format("Y-m-d"),
                "ngay_nhan" => '2025-06-10',
                "trang_thai" => 0,
            ],
        ]);
    }
}