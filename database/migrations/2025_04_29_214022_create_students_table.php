<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('student_id')->primary();
            $table->string('f_name');
            $table->string('l_name');
            $table->date('d_birth');
            $table->string('phone_num');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('category_id')->nullable();
            $table->string('profile_picture')->nullable(); // Menambahkan kolom profile_picture
            $table->timestamps();

            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};