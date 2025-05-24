<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->unsignedInteger('time_slot_id')->primary();
            $table->string('category_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('subject_id');
            $table->string('teacher_id'); // Diperbaiki menjadi string
            $table->string('classroom');
            $table->timestamps();

            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};