<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SinhVien;
use Illuminate\Support\Facades\Hash;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SinhVien::insert([
            [
                "ma_sv" => "0306221",
                "id_lop" => 1,
                "id_ho_so" => 4,
                "chuc_vu" => 0,
                'password' => Hash::make('Thinh3988@'),
                "trang_thai" => 0,
            ],
            [
                "ma_sv" => "0306229",
                "id_lop" => 1,
                "id_ho_so" => 14,
                "chuc_vu" => 0,
                "mat_khau" => bcrypt('1a@'),
                "trang_thai" => 0,
            ],
            [
                "ma_sv" => "0306222",
                "id_lop" => 2,
                "id_ho_so" => 5,
                "chuc_vu" => 0,
                'password' => Hash::make('Thinh3988@'),
                "trang_thai" => 0,
            ],
            [
                "ma_sv" => "0306231",
                "id_lop" => 3,
                "id_ho_so" => 6,
                "chuc_vu" => 0,
                'password' => Hash::make('Thinh3988@'),
                "trang_thai" => 0,
            ],
            [
                "ma_sv" => "0306232",
                "id_lop" => 3,
                "id_ho_so" => 7,
                "chuc_vu" => 0,
                'password' => Hash::make('Thinh3988@'),
                "trang_thai" => 0,
            ],
            [
                "ma_sv" => "0306233",
                "id_lop" => 3,
                "id_ho_so" => 8,
                "chuc_vu" => 0,
                'password' => Hash::make('Thinh3988@'),
                "trang_thai" => 0,
            ],
        ]);
    }
}