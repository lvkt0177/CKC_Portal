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
        Schema::create('bien_ban_shcn', function (Blueprint $table) {
            $table->id();
            //id_lop
            $table->nullableMorphs('lop'); 

            //id_sinh_vien
            $table->foreignId('id_sv')->constrained('sinhvien')->onDelete('cascade');

            //id_giang_vien
            $table->foreignId('id_gvcn')->constrained('users')->onDelete('cascade');

            //id_tuan
            $table->foreignId('id_tuan')->constrained('tuan')->onDelete('cascade');
            //tiêu đề
            $table->string('tieu_de', 255);

            //nội dung
            $table->longText('noi_dung');

            //thời gian bắt đầu
            $table->datetime('thoi_gian_bat_dau');

            //thời gian kết thúc
            $table->datetime('thoi_gian_ket_thuc');

            //số lượng sinh viên
            $table->integer('so_luong_sinh_vien')->default(0);

            //vắng mặt
            $table->integer('vang_mat')->default(0);

            //trạng thái
            $table->integer('trang_thai')->default(0); // 0: chờ duyệt, 1: đã duyệt, 2: đã hủy

            
            //

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bien_ban_shcn');
    }
};
