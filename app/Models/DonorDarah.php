<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorDarah extends Model
{
    use HasFactory;

    protected $table = 'tb_donordarah';
    protected $casts = [
        'dokumentasi' => 'array',
    ];
    

    protected $fillable = [
        'tgl', 
        'status', 
        'id_mitra',
        'jml_partisipan', 
        'jml_donor', 
        'id_user',
        'dokumentasi'
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra');
    }

    public function partisipans()
    {
        return $this->belongsToMany(Partisipan::class, 'tb_donordarah_partisipan', 'id_donordarah', 'id_partisipan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
