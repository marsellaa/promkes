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
        Schema::create('tb_flyer', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->string('jenis_info');
            $table->string('tema');
            $table->unsignedBigInteger('id_dokter');
            $table->unsignedBigInteger('id_user');
            $table->string('dokumentasi')->nullable();
            $table->timestamps();

            $table->foreign('id_dokter')->references('id')->on('tb_dokter')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_flyer');
    }
};
