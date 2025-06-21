<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ThoiKhoaBieu;

class ThoiKhoaBieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ThoiKhoaBieu::insert([
            [
            'id_tuan'=> 181,
            'id_lop_hoc_phan'=>1,
            'id_phong'=>1,	
            'tiet_bat_dau'=>1,	
            'tiet_ket_thuc'=>3,
            'ngay'=>"2025/6/16",	
            ],
        ]);
    }
}