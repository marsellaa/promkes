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
        Schema::create('tb_healthtalk', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->unsignedBigInteger('id_dokter');
            $table->string('tema_ht');
            $table->enum('status', ['Y', 'T', 'P']);
            $table->unsignedBigInteger('id_mitra');
            $table->unsignedBigInteger('id_partisipan');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_dokter')->references('id')->on('tb_dokter')->onDelete('cascade');
            $table->foreign('id_mitra')->references('id')->on('tb_mitra')->onDelete('cascade');
            $table->foreign('id_partisipan')->references('id')->on('tb_partisipan')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_healthtalk');
    }
};