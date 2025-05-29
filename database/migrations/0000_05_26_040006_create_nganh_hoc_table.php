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
        Schema::create('nganh_hoc', function (Blueprint $table) {
            $table->id();

            //id khoa
            $table->foreignId('id_khoa')->constrained('khoa')->onDelete('cascade');

            //tên ngành học
            $table->string('ten_nganh', 100);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nganh_hoc');
    }
};
