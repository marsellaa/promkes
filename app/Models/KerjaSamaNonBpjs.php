<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerjaSamaNonBpjs extends Model
{
    use HasFactory;

    protected $table = 'tb_kerjasamanonbpjs';

    protected $guarded = ['id'];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Accessor untuk mendapatkan periode dari tgl_mulai
    public function getPeriodeAttribute()
    {
        return date('F Y', strtotime($this->tgl_mulai));
    }
}
