<?php

namespace Database\Seeders;

use App\Models\LoaiGiay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoaiGiaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoaiGiay::insert([
            [
                "ten_giay" => 'Giấy xác nhận học sinh, sinh viên',
                "trang_thai" => 0,
            ],
        ]);
    }
}