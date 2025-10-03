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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');               // Tiêu đề
            $table->text('content');               // Nội dung (CKEditor)
            $table->string('thumb')->nullable();   // Ảnh đại diện
            $table->boolean('status')->default(1); // Trạng thái (1: hiển thị, 0: ẩn)
            $table->date('published_at')->nullable(); // Ngày đăng
            $table->timestamps();                  // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
