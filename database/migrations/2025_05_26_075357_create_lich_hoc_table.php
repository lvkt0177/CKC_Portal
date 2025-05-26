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
        Schema::create('lich_hoc', function (Blueprint $table) {
            $table->id();
            //id_lop_hoc_phan
            $table->foreignId('id_lop_hoc_phan')
                ->constrained('lop_hoc_phan')
                ->onDelete('cascade');
            //id_phong
            $table->foreignId('id_phong')
                ->constrained('phong')
                ->onDelete('cascade');

            //tiết bắt đầu
            $table->integer('tiet_bat_dau');
            //tiết kết thúc
            $table->integer('tiet_ket_thuc');

            //thứ
            $table->integer('thu');

            //thời gian bắt đầu
            $table->date('thoi_gian_bat_dau');

            //số tuần
            $table->integer('so_tuan')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_hoc');
    }
};
