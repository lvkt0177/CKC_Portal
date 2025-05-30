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
            //id_user
            $table->foreignId('id_gv')->constrained('users')->onDelete('cascade');

            //id_file
            $table->foreignId('id_file')->nullable()->constrained('file')->onDelete('set null');

            //từ ai - integer
            $table->integer('tu_ai')->default(0);

            //ngày gửi
            $table->date('ngay_gui');

            //tiêu đề
            $table->string('tieu_de', 255);
            
            //nội dung
            $table->longText('noi_dung');

            //trạng thái
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
