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
        Schema::create('binh_luan', function (Blueprint $table) {
            $table->id();
            //id_sinh_vien
            $table->foreignId('id_sinh_vien')->constrained('sinhvien')->onDelete('cascade');
            //id_thong_bao
            $table->foreignId('id_thong_bao')->constrained('thong_bao')->onDelete('cascade');

            //nội dung bình luận
            $table->longText('noi_dung');

            // bình luận cha
            $table->foreignId('id_binh_luan_cha')->nullable()->constrained('binh_luan')->onDelete('cascade');

            // id_reply
            $table->foreignId('id_sv_tra_loi')->nullable()->constrained('binh_luan')->onDelete('cascade');

            // trạng thái bình luận
            $table->integer('trang_thai')->default(1); // 0: đã khoá, 1: không khoá
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binh_luan');
    }
};
