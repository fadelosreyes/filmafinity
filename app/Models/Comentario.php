<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    /** @use HasFactory<\Database\Factories\ComentarioFactory> */
    use HasFactory;

    protected $fillable = ['texto', 'user_id'];

    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }

    public function comentable()
    {
        return $this->morphto();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
