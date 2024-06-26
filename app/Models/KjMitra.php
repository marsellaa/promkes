<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KjMitra extends Model
{
    use HasFactory;

    protected $table = 'tb_kjmitra';

    protected $fillable = [
        'tgl',
        'id_mitra',
        'tujuan',
        'id_user',
        'dokumentasi'
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
