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
        Schema::create('hoc_phi', function (Blueprint $table) {
            $table->id();
            //id_hoc_ky
            $table->foreignId('id_hoc_ky')->constrained('hoc_ky')->onDelete('cascade');

            $table->foreignId('id_sinh_vien')->constrained('sinhvien')->onDelete('cascade');

            $table->decimal('tong_tien', 10, 2)->default(0.00);

            $table->integer('trang_thai')->default(0); // 0: chưa đóng, 1: đã đóng
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoc_phi');
    }
};
