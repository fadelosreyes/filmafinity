<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    /** @use HasFactory<\Database\Factories\ComentarioFactory> */
    use HasFactory;

    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }

    public function comentable()
    {
        return $this->morphto();
    }
}
