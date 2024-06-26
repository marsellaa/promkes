<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'tb_dokter';

    // Menentukan kolom yang bisa diisi
    protected $fillable = [
        'id',
        'nama',
        'nipnib',
        'subdivisi',
        'spesialisasi'
    ];
}