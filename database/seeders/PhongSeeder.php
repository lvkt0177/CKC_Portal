<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Phong;

class PhongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Phong::insert([
            [
                'ten' => 'F7.1',
                'so_luong' => 50,
                'loai_phong' => 1,
            ],
            [
                'ten' => 'F7.2',
                'so_luong' => 120,
                'loai_phong' => 1,
            ],
            [
                'ten' => 'F7.3',
                'so_luong' => 70,
                'loai_phong' => 1,
            ],
            [
                'ten' => 'F7.4',
                'so_luong' => 80,
                'loai_phong' => 1,
            ],
            [
                'ten' => 'F7.5',
                'so_luong' => 90,
                'loai_phong' => 1,
            ],
            [
                'ten' => 'F7.6',
                'so_luong' => 40,
                'loai_phong' => 1,
            ],
        ]);
    }
}
