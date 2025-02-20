<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    /** @use HasFactory<\Database\Factories\FichaFactory> */
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion'];

    public function fichable()
    {
        return $this->morphto();
    }

    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }
}
