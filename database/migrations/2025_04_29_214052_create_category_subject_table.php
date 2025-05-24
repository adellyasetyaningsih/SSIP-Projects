<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('category_subject', function (Blueprint $table) {
            $table->string('category_id'); // Pastikan tipe data sesuai dengan tabel categories
            $table->string('subject_id'); // Pastikan tipe data sesuai dengan tabel subjects
            $table->primary(['category_id', 'subject_id']);

            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_subject');
    }
};