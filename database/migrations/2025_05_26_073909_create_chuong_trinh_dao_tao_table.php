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
        Schema::create('chuong_trinh_dao_tao', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_chuyen_nganh')->constrained('chuyen_nghanh')->onDelete('cascade');

            $table->string('ten_chuong_trinh_dao_tao', 100);

            $table->integer('tong_tin_chi')->default(0);

            $table->integer('trang_thai')->default(0);

            $table->integer('thoi_gian')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chuong_trinh_dao_tao');
    }
};
