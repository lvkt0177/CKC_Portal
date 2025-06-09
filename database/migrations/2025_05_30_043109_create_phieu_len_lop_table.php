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
        Schema::create('phieu_len_lop', function (Blueprint $table) {
            $table->id();
            //id_lop_hoc_phan
            $table->foreignId('id_lop_hoc_phan')
                ->constrained('lop_hoc_phan')
                ->onDelete('cascade');
            
            //id_phong
            $table->foreignId('id_phong')
                ->constrained('phong')
                ->onDelete('cascade');

            //id_tuan
            $table->foreignId('id_tuan')->constrained('tuan')->onDelete('cascade');
            //tiet_bat_dau - integer
            $table->integer('tiet_bat_dau')->default(0);

            //so_tiet
            $table->integer('so_tiet')->default(0);

            //ngay
            $table->date('ngay');

            //si_so
            $table->integer('si_so')->default(0);

            //hien_dien
            $table->integer('hien_dien')->default(0);

            //noi_dung - text
            $table->text('noi_dung')->nullable();
            //ghi_chu - text
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_len_lop');
    }
};