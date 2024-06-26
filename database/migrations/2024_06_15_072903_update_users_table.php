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
        Schema::table('users', function (Blueprint $table) {
            // Drop kolom email_verified_at
            $table->dropColumn('email_verified_at', 'last_name');
            
            // Tambahkan kolom yang dibutuhkan

    
            $table->unsignedBigInteger('id_role')->after('email'); // Menambahkan kolom id_role
            $table->string('phone_number')->nullable()->after('password');
            
            
            // Menambahkan foreign key constraint
            $table->foreign('id_role')->references('id')->on('tb_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kembali kolom email_verified_at
            $table->timestamp('email_verified_at')->nullable();

            // Hapus kolom yang baru ditambahkan
            $table->dropForeign(['id_role']);
            $table->dropColumn('username');
            $table->dropColumn('id_role');
            $table->dropColumn('phone_number');
            $table->dropColumn('profile_picture');
        });
    }
};