<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'tb_jawaban';

    protected $fillable = ['id_feedback', 'id_pertanyaan', 'jawaban'];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'id_feedback');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan');
    }
}