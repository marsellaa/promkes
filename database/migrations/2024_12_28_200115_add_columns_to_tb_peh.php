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
        Schema::table('tb_peh', function (Blueprint $table) {
            
            $table->string('jam')->nullable();
            $table->unsignedBigInteger('narasumber_pengganti')->nullable();
            $table->foreign('narasumber_pengganti')->references('id')->on('tb_dokter')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_peh', function (Blueprint $table) {
            // Menghapus kolom yang telah ditambahkan
            $table->dropForeign(['narasumber_pengganti']);
            $table->dropColumn(['narasumber_pengganti', 'jam']);
        });
    }
};
