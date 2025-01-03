<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Peh extends Model
{
    use HasFactory;

    protected $table = 'tb_peh';

    protected $guarded = ['id'];
    protected $fillable = 
    [
        'tgl',
        'id_dokter',
        'tema',
        'status',
        'id_user',
        'jml_penonton',
        'jam',  // Tambahkan kolom jam
        'narasumber_pengganti',  
        'host'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function dokterPengganti()
    {
        return $this->belongsTo(Dokter::class, 'narasumber_pengganti');
    }
}
