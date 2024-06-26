<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'tb_feedback';

    protected $fillable = [
        'tgl', 'nama_pasien', 'akun_ig', 'akun_fb', 'akun_tiktok', 'masukan', 'id_user'
    ];

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_feedback');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}