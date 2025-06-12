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
        Schema::create('tuan', function (Blueprint $table) {
            $table->id();
            //id_nawm
            $table->foreignId('id_nam')
                ->constrained('nam')
                ->onDelete('cascade');
                
            $table->integer('tuan');
            //
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        zxSchema::dropIfExists('tuan');
    }
};