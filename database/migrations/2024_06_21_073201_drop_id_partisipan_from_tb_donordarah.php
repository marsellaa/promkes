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
            $table->dropForeign(['id_partisipan']);
            $table->dropColumn('id_partisipan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_donordarah', function (Blueprint $table) {
    
            $table->unsignedBigInteger('id_partisipan')->nullable();
            
            $table->foreign('id_partisipan')->references('id')->on('tb_partisipan')->onDelete('cascade');
        });
    }
};
