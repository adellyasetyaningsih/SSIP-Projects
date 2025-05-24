<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teacher_subject', function (Blueprint $table) {
            $table->string('teacher_id');
            $table->string('subject_id');
            $table->unsignedInteger('time_slot_id')->index(); // Sesuaikan tipe data dan tambahkan index

            // Composite primary key (tanpa time_slot_id)
            $table->primary(['teacher_id', 'subject_id']);

            // Foreign key constraints
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');
            $table->foreign('time_slot_id')->references('time_slot_id')->on('time_slots')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_subject');
    }
};
