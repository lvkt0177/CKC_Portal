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
        Schema::create('lop', function (Blueprint $table) {
            $table->id();
            //tên lớp
            $table->string('ten_lop', 100);
            //id niên khoá
            $table->foreignId('id_nien_khoa')->constrained('nien_khoa')->onDelete('cascade');
            
            $table->foreignId('id_gvcn')->constrained('users')->onDelete('cascade');
            //id ngành học
            $table->foreignId('id_nganh_hoc')->nullable()->constrained('nganh_hoc')->onDelete('cascade');
            
            $table->integer('si_so')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lop');
    }
};