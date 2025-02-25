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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relasi ke tabel categories
            $table->enum('question_type', ['text', 'image']); // Menentukan tipe pertanyaan
            $table->text('question_text')->nullable(); // Teks pertanyaan (opsional jika tipe pertanyaan adalah gambar)
            $table->string('question_image')->nullable(); // Gambar pertanyaan (opsional jika tipe pertanyaan adalah teks)
            $table->string('option_a'); // Opsi A
            $table->string('option_b'); // Opsi B
            $table->string('option_c'); // Opsi C
            $table->string('option_d'); // Opsi D
            $table->string('correct_answer'); // Jawaban benar (A, B, C, atau D)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
