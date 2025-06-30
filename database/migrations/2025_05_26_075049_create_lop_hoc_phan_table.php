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
        Schema::create('lop_hoc_phan', function (Blueprint $table) {

            $table->id();

            $table->string('ten_hoc_phan', 100);

            $table->foreignId('id_giang_vien')->nullable()->constrained('users')->onDelete('cascade');

            $table->foreignId('id_chuong_trinh_dao_tao')->nullable()->constrained('chuong_trinh_dao_tao')->onDelete('cascade');

            $table->foreignId('id_lop')->nullable()->constrained('lop')->onDelete('cascade');

            $table->integer('loai_lop_hoc_phan')->default(0);

            $table->integer('so_luong_sinh_vien')->default(0);

            $table->integer('gioi_han_dang_ky')->nullable()->default(0);
            //loai_mon
            $table->integer('loai_mon')->default(0); // 0: lý thuyết, 1: thực hành, 2: mo đun

            $table->integer('trang_thai')->default(0);



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lop_hoc_phan');
    }
};