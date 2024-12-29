<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHostToTbPeh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_peh', function (Blueprint $table) {
            $table->string('host')->nullable();  // Menambahkan kolom host
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_peh', function (Blueprint $table) {
            $table->dropColumn('host');  // Menghapus kolom host jika rollback
        });
    }
}
