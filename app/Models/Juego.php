<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    /** @use HasFactory<\Database\Factories\JuegoFactory> */
    use HasFactory;

    public function ficha()
    {
        return $this->morphOne(Ficha::class, 'fichable');
    }
}
