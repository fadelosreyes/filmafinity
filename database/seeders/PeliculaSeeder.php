<?php

namespace Database\Seeders;

use App\Models\Ficha;
use App\Models\Pelicula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelicula::factory(50)->create()->each(function ($pelicula) {
            Ficha::create([
                'titulo' => fake()->sentence,
                'descripcion' => fake()->text(50),
                'fichable_id' => $pelicula->id,
                'fichable_type' => Pelicula::class,
            ]);
        });
    }
}
