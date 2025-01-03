<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'tb_roles';

    protected $guarded = ['id'];

    protected $fillable = ['nama'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_role', 'id');
    }

}

