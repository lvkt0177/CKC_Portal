<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dang_ky_hg_tl', function (Blueprint $table) {
            //id sinh viên
            $table->foreignId('id_sinh_vien')->constrained('sinhvien')->onDelete('cascade');
            
            //id lớp học phần
            $table->foreignId('id_lop_hoc_phan')->constrained('lop_hoc_phan')->onDelete('cascade');

            //so_tien
            $table->float('so_tien')->default(0);

            //loai_dong
            $table->integer('loai_dong')->default(0); // 0: học ghép 1. học kì phụ 2. thi lại
            
            //trạng thái
            $table->integer('trang_thai')->default(0); //0: chưa đóng, 1: đã đóng
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dang_ky');
    }
};
