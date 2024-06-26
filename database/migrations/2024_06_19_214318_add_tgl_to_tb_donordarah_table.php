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
        Schema::table('tb_donordarah', function (Blueprint $table) {
            $table->date('tgl')->after('id')->nullable(); // Menambahkan kolom tgl setelah kolom id, nullable jika ada data lama yang tidak memiliki nilai tgl
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_donordarah', function (Blueprint $table) {
            $table->dropColumn('tgl'); // Menghapus kolom tgl jika di-rollback
        });
    }
};
