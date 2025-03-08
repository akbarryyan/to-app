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
        // migration untuk announcements
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul pengumuman
            $table->text('message'); // Isi pesan
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Admin yang bikin
            $table->boolean('is_active')->default(true); // Status aktif/tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
