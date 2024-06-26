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
        Schema::create('tb_jawaban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_feedback'); // relasi ke tb_feedback
            $table->unsignedBigInteger('id_pertanyaan'); // relasi ke tb_pertanyaan
            $table->text('jawaban');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_feedback')->references('id')->on('tb_feedback')->onDelete('cascade');
            $table->foreign('id_pertanyaan')->references('id')->on('tb_pertanyaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_jawaban');
    }
};
