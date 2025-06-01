<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dang_ky_giay', function (Blueprint $table) {
            $table->id();
            //id_sinh_viên
            $table->foreignId('id_sinh_vien')->constrained('sinhvien')->onDelete('cascade');
            //id_user
            $table->foreignId('id_giang_vien')->nullable()->constrained('users')->onDelete('cascade');

            //id_loai_giay
            $table->foreignId('id_loai_giay')->constrained('loai_giay')->onDelete('cascade');

            //ngày đăng ký
            $table->date('ngay_dang_ky');

            //ngày nhận
            $table->date('ngay_nhan')->nullable();

            //trạng thái
            $table->integer('trang_thai')->default(0); // 0: chờ duyệt, 1: đã duyệt, 2: đã nhận, 3: từ chối


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dang_ky_giay');
    }
};