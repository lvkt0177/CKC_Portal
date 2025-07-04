<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HoSo;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class HoSoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $vietnamese_first_names = ["Nguyễn", "Trần", "Lê", "Phạm", "Hoàng", "Phan", "Vũ", "Đặng", "Bùi", "Đỗ"];
        $vietnamese_middle_names = ["Văn", "Hữu", "Đức", "Thanh", "Công", "Ngọc", "Minh", "Xuân"];
        $vietnamese_last_names = ["Nam", "Tú", "Dũng", "Hưng", "Phong", "Hiếu", "Hải", "Sơn", "Khánh", "Long"];

        $faker = Faker::create('vi_VN');
        $users = [];

        $baseEmailNumber = 177; 

        for ($i = 1; $i < 37; $i++) {
            $ho = $vietnamese_first_names[array_rand($vietnamese_first_names)];
            $dem = $vietnamese_middle_names[array_rand($vietnamese_middle_names)];
            $ten = $vietnamese_last_names[array_rand($vietnamese_last_names)];
            $full_name = "$ho $dem $ten";

            $emailNumber = $baseEmailNumber + $i - 1;
            $email = "lvkt0" . str_pad($emailNumber, 3, '0', STR_PAD_LEFT) . "@gmail.com";

            $users[] = [
                'ho_ten' => $full_name,
                'email' => $email,
                'password' => bcrypt('Thinh3988@'),
                'so_dien_thoai' => '090' . str_pad($i, 7, '0', STR_PAD_LEFT),
                'ngay_sinh' => $faker->date('Y-m-d', '-18 years'),
                'gioi_tinh' => 'Nam',
                'cccd' => '0011' . str_pad($i, 8, '0', STR_PAD_LEFT),
                'dia_chi' => $faker->address(),
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ];
        }
        HoSo::insert($users);
                
        HoSo::insert([
            [
                'ho_ten' => 'Le Van Khanh Thinh',
                'email' => 'lethinh3988@gmail.com',
                'password' => bcrypt('12345678'),
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
                'password' => bcrypt('12345678'),
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
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0123456789',
                'ngay_sinh' => '2000-01-01',
                'gioi_tinh' => 'Nam',
                'cccd' => '0690123456',
                'dia_chi' => '999 Vo Nguyen Giap, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ],

            [
                'ho_ten' => 'Pham Minh Duc',
                'email' => 'pmd@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0912345678',
                'ngay_sinh' => '1999-09-09',
                'gioi_tinh' => 'Nam',
                'cccd' => '0612345678',
                'dia_chi' => '15 Tran Hung Dao, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ],
            [
                'ho_ten' => 'Dang Thi Huong',
                'email' => 'dth@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0968123456',
                'ngay_sinh' => '2001-03-21',
                'gioi_tinh' => 'Nu',
                'cccd' => '0678945612',
                'dia_chi' => '85 Le Duan, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ],
            [
                'ho_ten' => 'Le Tuan Kiet',
                'email' => 'ltk@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0933456789',
                'ngay_sinh' => '2000-07-15',
                'gioi_tinh' => 'Nam',
                'cccd' => '0634567890',
                'dia_chi' => '36 Phan Dinh Phung, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ],
            [
                'ho_ten' => 'Nguyen Bao Tram',
                'email' => 'nbt@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0909876543',
                'ngay_sinh' => '2002-05-30',
                'gioi_tinh' => 'Nu',
                'cccd' => '0609876543',
                'dia_chi' => '120 Kim Ma, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ],
            [
                'ho_ten' => 'Vo Quoc Khanh',
                'email' => 'vqk@fe.edu.vn',
                'password' => bcrypt('12345678'),
                'so_dien_thoai' => '0977543210',
                'ngay_sinh' => '1998-12-12',
                'gioi_tinh' => 'Nam',
                'cccd' => '0665432109',
                'dia_chi' => '42 Lang Ha, Hanoi',
                'anh' => 'assets/admin/images/ho_so/user_image.jpg',
            ],
  

        ]);
    }
}