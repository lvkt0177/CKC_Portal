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
        Schema::create('thong_bao', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_gv')->constrained('users')->onDelete('cascade');

            $table->text('tu_ai');

            $table->date('ngay_gui');

            $table->string('tieu_de', 255);
            
            $table->longText('noi_dung');

            $table->integer('trang_thai')->default(0); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thong_bao');
    }
};
