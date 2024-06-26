<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthTalk extends Model
{
    use HasFactory;

    protected $table = 'tb_healthtalk';

    protected $fillable = [
        'tgl',
        'id_dokter',
        'tema_ht',
        'status',
        'id_user',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    
    }
    
    public function partisipans()
    {
        return $this->belongsToMany(Partisipan::class, 'tb_healthtalk_partisipan', 'id_healthtalk', 'id_partisipan');
    }

    public function mitras()
    {
        return $this->belongsToMany(Mitra::class, 'tb_healthtalk_mitra', 'id_healthtalk', 'id_mitra');
    }
}
