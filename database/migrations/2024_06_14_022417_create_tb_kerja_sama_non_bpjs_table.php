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
        Schema::create('tb_kerjaSamaNonBpjs', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
            $table->unsignedBigInteger('id_mitra'); // relasi ke tb_mitra
            $table->string('jenis_kerjasama');
            $table->enum('status', ['Baru', 'Perpanjangan']);
            $table->unsignedBigInteger('id_user'); // relasi ke tb_users
            $table->string('no_telp_pic');
            $table->string('dokumentasi')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_mitra')->references('id')->on('tb_mitra')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kerjaSamaNonBpjs');
    }
};
