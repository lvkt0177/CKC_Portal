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
            // 1
            [
                'ten_mon' => "Tiếng Anh 1",
                "loai_mon_hoc" => 0,
            ],
            // 2
            [
                'ten_mon' => "Giáo dục thể chất 1",
                "loai_mon_hoc" => 1,
            ],
            // 3
            [
                'ten_mon' => "Pháp luật",
                "loai_mon_hoc" => 0,
            ],
            // 4
            [
                'ten_mon' => "Toán cao cấp",
                "loai_mon_hoc" => 0,
            ],
            // 5
            [
                'ten_mon' => "Toán rời rạc và Lý thuyết đồ thị",
                "loai_mon_hoc" => 0,
            ],
            // 6
            [
                'ten_mon' => "Phần cứng máy tính",
                "loai_mon_hoc" => 0,
            ],
            // 7
            [
                'ten_mon' => "Nhập môn lập trình",
                "loai_mon_hoc" => 0,
            ],
            // 8
            [
                'ten_mon' => "Tin học ứng dụng",
                "loai_mon_hoc" => 0,
            ],
            // 9
            [
                'ten_mon' => "TT Phần cứng máy tính",
                "loai_mon_hoc" => 1,
            ],
            // 10
            [
                'ten_mon' => "TT Nhập môn lập trình",
                "loai_mon_hoc" => 1,
            ],
            // 11
            [
                'ten_mon' => "Tiếng Anh 2",
                "loai_mon_hoc" => 0,
            ],
            // 12
            [
                'ten_mon' => "Giáo dục thể chất 2",
                "loai_mon_hoc" => 1,
            ],
            // 13
            [
                'ten_mon' => "Vật lý đại cương",
                "loai_mon_hoc" => 0,
            ],
            // 14
            [
                'ten_mon' => "Cơ sở dữ liệu",
                "loai_mon_hoc" => 0,
            ],
            // 15
            [
                'ten_mon' => "Cấu trúc dữ liệu và giải thuật",
                "loai_mon_hoc" => 0,
            ],
            // 16
            [
                'ten_mon' => "Mạng máy tính",
                "loai_mon_hoc" => 0,
            ],
            // 17
            [
                'ten_mon' => "Thiết kế Web",
                "loai_mon_hoc" => 0,
            ],
            // 18
            [
                'ten_mon' => "TT Thiết kế Web",
                "loai_mon_hoc" => 1,
            ],
            // 19
            [
                'ten_mon' => "TT Cấu trúc dữ liệu và giải thuật",
                "loai_mon_hoc" => 1,
            ],
            // 20
            [
                'ten_mon' => "TT Mạng máy tính",
                "loai_mon_hoc" => 1,
            ],
            // 21
            [
                'ten_mon' => "Giáo dục quốc phòng và an ninh",
                "loai_mon_hoc" => 1,
            ],
            // 22
            [
                'ten_mon' => "Giáo dục chính trị 1",
                "loai_mon_hoc" => 1,
            ],
            // 23
            [
                'ten_mon' => "Tiếng Anh 3",
                "loai_mon_hoc" => 0,
            ],
            // 24
            [
                'ten_mon' => "Hệ quản trị cơ sở dữ liệu",
                "loai_mon_hoc" => 0,
            ],
            // 25
            [
                'ten_mon' => "Quản trị hệ thống mạng Windows",
                "loai_mon_hoc" => 0,
            ],
            // 26
            [
                'ten_mon' => "Phương pháp lập trình hướng đối tượng",
                "loai_mon_hoc" => 0,
            ],
            // 27
            [
                'ten_mon' => "LT Web PHP cơ bản",
                "loai_mon_hoc" => 0,
            ],
            // 28
            [
                'ten_mon' => "TT Hệ quản trị cơ sở dữ liệu",
                "loai_mon_hoc" => 1,
            ],
            // 29
            [
                'ten_mon' => "TT Quản trị hệ thống mạng Windows",
                "loai_mon_hoc" => 1,
            ],
            // 30
            [
                'ten_mon' => "TT Phương pháp lập trình hướng đối tượng",
                "loai_mon_hoc" => 1,
            ],
            // 31
            [
                'ten_mon' => "Giáo dục chính trị 2",
                "loai_mon_hoc" => 1,
            ],
            // 32
            [
                'ten_mon' => "Tiếng Anh chuyên ngành CNTT",
                "loai_mon_hoc" => 0,
            ],
            // 33
            [
                'ten_mon' => "Lập trình Windows + ĐAMH",
                "loai_mon_hoc" => 0,
            ],
            // 34
            [
                'ten_mon' => "Lập trình Python",
                "loai_mon_hoc" => 0,
            ],
            // 35
            [
                'ten_mon' => "Phân tích thiết kế hệ thống thông tin",
                "loai_mon_hoc" => 0,
            ],
            // 36
            [
                'ten_mon' => "Ngôn ngữ lập trình Java",
                "loai_mon_hoc" => 0,
            ],
            // 37
            [
                'ten_mon' => "Nodejs Platform",
                "loai_mon_hoc" => 0,
            ],
            // 38
            [
                'ten_mon' => "TT Lập trình Windows",
                "loai_mon_hoc" => 1,
            ],
            // 39
            [
                'ten_mon' => "Hệ điều hành Linux",
                "loai_mon_hoc" => 0,
            ],
            // 40
            [
                'ten_mon' => "Dịch vụ mạng",
                "loai_mon_hoc" => 0,
            ],
            // 41
            [
                'ten_mon' => "Cấu hình và quản trị thiết bị mạng Cisco",
                "loai_mon_hoc" => 0,
            ],
            // 42
            [
                'ten_mon' => "Công nghệ phần mềm",
                "loai_mon_hoc" => 0,
            ],
            // 43
            [
                'ten_mon' => "Kiểm thử phần mềm",
                "loai_mon_hoc" => 0,
            ],
            // 44
            [
                'ten_mon' => "Công cụ và môi trường phát triển phần mềm",
                "loai_mon_hoc" => 0,
            ],
            // 45
            [
                'ten_mon' => "Lập trình ASP.NET Core",
                "loai_mon_hoc" => 0,
            ],
            // 46
            [
                'ten_mon' => "Lập trình Web PHP nâng cao",
                "loai_mon_hoc" => 0,
            ],
            // 47
            [
                'ten_mon' => "Lập trình Front End",
                "loai_mon_hoc" => 0,
            ],
            // 48
            [
                'ten_mon' => "Tiếng Anh 2/6",
                "loai_mon_hoc" => 0,
            ],
            // 49
            [
                'ten_mon' => "Lập trình di động",
                "loai_mon_hoc" => 0,
            ],
            // 50
            [
                'ten_mon' => "Lập trình nhúng",
                "loai_mon_hoc" => 0,
            ],
            // 51
            [
                'ten_mon' => "Công nghệ lập trình đa nền tảng",
                "loai_mon_hoc" => 0,
            ],
            // 52
            [
                'ten_mon' => "Thiết kế hệ thống mạng",
                "loai_mon_hoc" => 0,
            ],
            // 53
            [
                'ten_mon' => "Bảo mật thiết bị mạng Cisco",
                "loai_mon_hoc" => 0,
            ],
            // 54
            [
                'ten_mon' => "Đồ án Bảo mật thiết bị mạng Cisco",
                "loai_mon_hoc" => 0,
            ],
            // 55
            [
                'ten_mon' => "Quản lý hệ thống Web và Mail Server",
                "loai_mon_hoc" => 0,
            ],
            // 56
            [
                'ten_mon' => "An ninh mạng",
                "loai_mon_hoc" => 0,
            ],
            // 57
            [
                'ten_mon' => "Quản trị mạng Linux",
                "loai_mon_hoc" => 0,
            ],
            // 58
            [
                'ten_mon' => "Đồ án lập trình Web",
                "loai_mon_hoc" => 0,
            ],
            // 59
            [
                'ten_mon' => "Thực tập Tốt nghiệp",
                "loai_mon_hoc" => 0,
            ],
            // 60
            [
                'ten_mon' => "Đồ án Tốt nghiệp",
                "loai_mon_hoc" => 0,
            ],
            // 61
            [
                'ten_mon' => "Thi Tốt nghiệp Chính trị",
                "loai_mon_hoc" => 0,
            ],
            // 62
            [
                'ten_mon' => "Đồ án lập trình di động",
                "loai_mon_hoc" => 0,
            ],
            // 63
            [
                'ten_mon' => "Đồ án Quản trị hệ thống mạng",
                "loai_mon_hoc" => 0,
            ],
        ]);

    }
}