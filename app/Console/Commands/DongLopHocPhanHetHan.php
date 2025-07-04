<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\LopHocPhanService;

class DongLopHocPhanHetHan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dong-lop-hoc-phan-het-han';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tự động khoá lớp học phần đã quá hạn đăng ký';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service->dongCacLopHetHanDangKy();
        $this->info('Đã kiểm tra và khoá các lớp học phần quá hạn.');
    }
}
