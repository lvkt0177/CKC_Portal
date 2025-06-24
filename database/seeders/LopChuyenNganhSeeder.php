<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\LopChuyenNganh;

class LopChuyenNganhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $lops = [
            ['ten_lop' => 'CDTH 23WEBC', 'id_chuyen_nganh' => 1,'id_nien_khoa' => 2,'id_gvcn' => 1],
            ['ten_lop' => 'CDTH 23DDC', 'id_chuyen_nganh' => 2,'id_nien_khoa' => 2,'id_gvcn' => 1],
            ['ten_lop' => 'CDTH 23MMTC',   'id_chuyen_nganh' => 3,'id_nien_khoa' => 2,'id_gvcn' => 1],
        ];

        foreach ($lops as $lop) {
            LopChuyenNganh::create([
                'ten_lop' => $lop['ten_lop'],
                'id_chuyen_nganh' => $lop['id_chuyen_nganh'],
                'id_nien_khoa' => $lop['id_nien_khoa'], 
                'id_gvcn' => $lop['id_gvcn'],      
                'si_so' => 0,
            ]);
        }
    }
}