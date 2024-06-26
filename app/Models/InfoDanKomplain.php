<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoDanKomplain extends Model
{
    use HasFactory;

    protected $table = 'tb_infodankomplain';

    protected $fillable = [
        'tgl',
        'jenis_berita',
        'media_sosial',
        'isi_berita',
        'kelompok',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
