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
        Schema::create('tb_donordarah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mitra'); // relasi ke tb_mitra
            $table->unsignedBigInteger('id_partisipan');
            $table->enum('status', ['Y', 'T']);
            $table->unsignedInteger('jml_partisipan');
            $table->unsignedInteger('jml_donor');
            $table->unsignedBigInteger('id_user'); // relasi ke tb_users
            $table->string('dokumentasi')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_mitra')->references('id')->on('tb_mitra')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_partisipan')->references('id')->on('tb_partisipan')->onDelete('cascade');
        });

        // Tabel pivot untuk relasi many-to-many antara tb_donordarah dan tb_partisipan
        Schema::create('tb_donordarah_partisipan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_donordarah');
            $table->unsignedBigInteger('id_partisipan');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_donordarah')->references('id')->on('tb_donordarah')->onDelete('cascade');
            $table->foreign('id_partisipan')->references('id')->on('tb_partisipan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_donordarah_partisipan');
        Schema::dropIfExists('tb_donordarah');
    }
};
