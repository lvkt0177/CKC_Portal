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
        Schema::create('yeu_cau_cap_lai_mat_khau', function (Blueprint $table) {
            $table->id();
            //id_sinh_vien
            $table->foreignId('id_sinh_vien')->constrained('sinhvien')->onDelete('cascade');
            // id_giang_vien
            $table->foreignId('id_giang_vien')->nullable()->constrained('users')->onDelete('cascade');

            $table->integer('loai')->default(0);
            $table->integer('trang_thai')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yeu_cau_cap_lai_mat_khau');
    }
};
