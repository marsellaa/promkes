<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tb_dokter', function (Blueprint $table) {
        $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
    });
}

public function down()
{
    Schema::table('tb_dokter', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
