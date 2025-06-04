<?php

namespace Database\Seeders;

use App\Models\MonHoc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MonHoc::insert([
            [
                'ten_mon' => "Tiếng Anh 1",
                "loai_mon_hoc" => 0,
            ],
            [
                'ten_mon' => "Tiếng Anh 2",
                "loai_mon_hoc" => 0,
            ],
            [
                'ten_mon' => "Tiếng Anh 3",
                "loai_mon_hoc" => 0,
            ],
            [
                'ten_mon' => "Tiếng Anh Chuyên Ngành CNTT",
                "loai_mon_hoc" => 0,
            ],
            [
                'ten_mon' => "Giáo dục thể chất 1",
                "loai_mon_hoc" => 1,
            ],

        ]);

    }
}