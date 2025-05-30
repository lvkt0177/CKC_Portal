<?php

namespace Database\Seeders;

use App;
use App\Models\NganhHoc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NganhHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NganhHoc::insert([
            [
                "id_khoa" => "1",
                "ten_nganh" => "Tin Học"
            ],
            [
                "id_khoa" => "5",
                "ten_nganh" => "Công Nghệ Kỹ Thuật Điện, Điện Tử"
            ],
            [
                "id_khoa" => "5",
                "ten_nganh" => "Công Nghệ Kỹ Thuật Điện Tử, Viễn Thông"
            ],
            [
                "id_khoa" => "3",
                "ten_nganh" => "Công Nghệ Kỹ Thuật Cơ Khí"
            ],
        ]);
    }
}