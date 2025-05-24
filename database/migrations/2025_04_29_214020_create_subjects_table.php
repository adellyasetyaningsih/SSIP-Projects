<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->string('subject_id'); // jangan pakai ->primary()
            $table->string('category_id')->nullable(); // Foreign key ke categories
            $table->string('file_path')->nullable();
            $table->string('title');
            $table->text('desc')->nullable();
            $table->timestamps(); // created_at & updated_at

            // Composite Primary Key
            $table->primary(['subject_id', 'title']);

            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
