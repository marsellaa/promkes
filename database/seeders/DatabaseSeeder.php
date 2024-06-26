<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\pasien;
use App\Models\dokter;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User::create([
        //     "name"=>"admin",
        //     "email"=>"admin@gmail.com",
        //     "password"=>"admin"
        // ]);

        // pasien::create([
        //     "id"=>"1",
        //     "namaPasien"=>"Chelsea Samsi Wijaya",
        //     "tanggalLahir"=>"2003/07/07",
        //     "jenisKelamin"=>"Perempuan"
        // ]);        pasien::create([
        //     "id"=>"2",
        //     "namaPasien"=>"Marsella",
        //     "tanggalLahir"=>"2003/10/23",
        //     "jenisKelamin"=>"Perempuan"
        // ]);


        
        // dokter::create([
        //     "id"=>"1",
        //     "namaDokter"=>"Chelsea Samsi Wijaya",
        //     "tanggalLahir"=>"2003/07/07",
        //     "spesialis"=>"THT"
        // ]);    
    }
}
