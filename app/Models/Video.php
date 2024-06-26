<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'tb_video';

    protected $fillable = [
        'tgl',
        'jenis_info',
        'tema',
        'id_dokter',
        'id_user',
        'dokumentasi',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
