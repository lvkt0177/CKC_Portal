<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SinhVien;
use App\Models\HoSo;
use Illuminate\Support\Facades\Hash;


class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SinhVien::insert([
            // Lớp thường - Khoá 22 - 12 SV
            ["ma_sv" => "03062201", "id_ho_so" => 1,  "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062202", "id_ho_so" => 2,  "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062203", "id_ho_so" => 3,  "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062204", "id_ho_so" => 4,  "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062205", "id_ho_so" => 5,  "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062206", "id_ho_so" => 6,  "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062207", "id_ho_so" => 7,  "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062208", "id_ho_so" => 8,  "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062209", "id_ho_so" => 9,  "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062210", "id_ho_so" => 10, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062211", "id_ho_so" => 11, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062212", "id_ho_so" => 12, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            
            // Lớp thường - Khoá 23 - 12 SV
            ["ma_sv" => "03062301", "id_ho_so" => 13, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062302", "id_ho_so" => 14, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062303", "id_ho_so" => 15, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062304", "id_ho_so" => 16, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062305", "id_ho_so" => 17, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062306", "id_ho_so" => 18, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062307", "id_ho_so" => 19, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062308", "id_ho_so" => 20, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062309", "id_ho_so" => 21, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062310", "id_ho_so" => 22, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062311", "id_ho_so" => 23, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062312", "id_ho_so" => 24, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],


            // Lớp thường - Kháo 24
            ["ma_sv" => "03062401", "id_ho_so" => 25, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062402", "id_ho_so" => 26, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062403", "id_ho_so" => 27, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062404", "id_ho_so" => 28, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062405", "id_ho_so" => 29, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062406", "id_ho_so" => 30, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062407", "id_ho_so" => 31, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062408", "id_ho_so" => 32, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062409", "id_ho_so" => 33, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062410", "id_ho_so" => 34, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062411", "id_ho_so" => 35, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],
            ["ma_sv" => "03062412", "id_ho_so" => 36, "password" => Hash::make('Thinh3988@'), "trang_thai" => 0],



            // 
        ]);
        
    }
}