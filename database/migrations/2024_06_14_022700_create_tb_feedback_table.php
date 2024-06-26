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
        Schema::create('tb_feedback', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->string('nama_pasien');
            $table->string('akun_ig')->nullable();
            $table->string('akun_fb')->nullable();
            $table->string('akun_tiktok')->nullable();
            $table->text('masukan')->nullable();
            $table->unsignedBigInteger('id_user'); // relasi ke tb_users
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_feedback');
    }
};
