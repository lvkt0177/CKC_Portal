<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HoSo;
class HoSoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        HoSo::insert([
            [
                'ho_ten' => 'Le Van Khanh Thinh',
                'email' => 'lvkt@fe.edu.vn',
                'so_dien_thoai' => '0857853419',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nam',
                'cccd' => '0621456789',
                'dia_chi' => '123 Nguyen Van Cu, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ],
            [
                'ho_ten' => 'Nguyen Thi Mai',
                'email' => 'ntm@fe.edu.vn',
                'so_dien_thoai' => '0987654321',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nu',
                'cccd' => '0684567890',
                'dia_chi' => '24 Ly Thuong Kiet, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ],
            [
                'ho_ten' => 'Tran Van An',
                'email' => 'tva@fe.edu.vn',
                'so_dien_thoai' => '0123456789',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nam',
                'cccd' => '0690123456',
                'dia_chi' => '999 Vo Nguyen Giap, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ]
        ]);
    }
}
