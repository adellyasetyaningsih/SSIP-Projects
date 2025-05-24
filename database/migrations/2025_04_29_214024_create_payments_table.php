<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('pay_ID'); // Auto-incrementing integer primary key
            $table->enum('pay_status', ['pending', 'confirmed', 'rejected'])->default('pending');
            $table->string('student_id'); // Sudah benar (string sesuai tabel students)
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};