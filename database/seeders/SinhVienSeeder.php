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
                "mat_khau" => Hash::make('1a@'),
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
        $lopChuyenNganh = [
            ['lop_id' => 3, 'lop_chuyen_nganh_id' => 1],
            ['lop_id' => 3, 'lop_chuyen_nganh_id' => 2],
            ['lop_id' => 3, 'lop_chuyen_nganh_id' => 3],
        ];

        $hoTenMau = ['Nguyễn Văn A', 'Trần Thị B', 'Lê Văn C', 'Phạm Thị D'];
        $maSVBatDau = 306300;
        $hoSoId = 15; // Bắt đầu từ ID hồ sơ 15

        foreach ($lopChuyenNganh as $index => $lop) {
            for ($i = 0; $i < 4; $i++) {
                $ten = $hoTenMau[$i];
                $email = 'sv' . $hoSoId . '@fe.edu.vn';

                // Tạo hồ sơ
                HoSo::create([
                    'ho_ten' => $ten,
                    'email' => $email,
                    'so_dien_thoai' => '0987' . rand(100000, 999999),
                    'ngay_sinh' => '2003-01-01',
                    'gioi_tinh' => ($i % 2 == 0) ? 'Nam' : 'Nữ',
                    'cccd' => '00120300' . rand(1000, 9999),
                    'dia_chi' => 'Hà Nội',
                    'anh' => 'assets/admin/images/ho_so/user_image.jpg',
                    'password' => Hash::make('12345678'),
                ]);

                // Tạo sinh viên
                SinhVien::create([
                    'ma_sv' => $maSVBatDau++,
                    'id_lop' => $lop['lop_id'],
                    'id_lop_chuyen_nganh' => $lop['lop_chuyen_nganh_id'],
                    'id_ho_so' => $hoSoId++,
                    'chuc_vu' => 0,
                    'password' => Hash::make('Thinh3988@'),
                    'trang_thai' => 0,
                ]);
            }
        }
    }
}