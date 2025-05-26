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
        Schema::create('lich_thi', function (Blueprint $table) {
            $table->id();
            //id_lop_hoc_phan
            $table->unsignedBigInteger('id_lop_hoc_phan')->index();
            //id_giam_thi_1
            $table->foreignId('id_giam_thi_1')->nullable()->constrained('users')->onDelete('set null');
            //id_giam_thi_2
            $table->foreignId('id_giam_thi_2')->nullable()->constrained('users')->onDelete('set null');
            //ngay_thi
            $table->date('ngay_thi');
            //gio_bat_dau
            $table->time('gio_bat_dau');
            //thoi_gian_thi
            $table->integer('thoi_gian_thi');

            //id_phong_thi - null
            $table->foreignId('id_phong_thi')->nullable()->constrained('phong')->onDelete('set null');

            //lần thi
            $table->integer('lan_thi')->default(1);
            //trạng thái
            $table->integer('trang_thai')->default(0); // 0: chưa thi, 1: đã thi, 2: kết thúc

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_thi');
    }
};
