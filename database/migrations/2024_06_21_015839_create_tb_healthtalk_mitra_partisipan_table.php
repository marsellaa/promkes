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
        Schema::create('tb_healthtalk_partisipan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_healthtalk');
            $table->unsignedBigInteger('id_partisipan');
            $table->timestamps();

            $table->foreign('id_healthtalk')->references('id')->on('tb_healthtalk')->onDelete('cascade');
            $table->foreign('id_partisipan')->references('id')->on('tb_partisipan')->onDelete('cascade');
        });

        Schema::create('tb_healthtalk_mitra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_healthtalk');
            $table->unsignedBigInteger('id_mitra');
            $table->timestamps();

            $table->foreign('id_healthtalk')->references('id')->on('tb_healthtalk')->onDelete('cascade');
            $table->foreign('id_mitra')->references('id')->on('tb_mitra')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_healthtalk_mitra');
        Schema::dropIfExists('tb_healthtalk_partisipan');
    }
};
