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
        Schema::create('loai_giay', function (Blueprint $table) {
            $table->id();
            //tên_giay
            $table->string('ten_giay')->unique();
            //trạng thái
            $table->integer('trang_thai')->default(true); // true: hoạt động, false: không hoạt động
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loai_giay');
    }
};
