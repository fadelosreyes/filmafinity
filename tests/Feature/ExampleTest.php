<?php

use App\Models\Ficha;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Pelicula;

uses(RefreshDatabase::class); // Esto reinicia la BD antes de cada test


test('la página principal funciona', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('el usuario puede eliminar una pelicula', function () {
    $usuario = User::factory()->create();
    $pelicula = Pelicula::factory()->create();
    $response = $this
        ->actingAs($usuario)
        ->delete('/peliculas/'.$pelicula->id);

    $this->assertAuthenticated();
    $response->assertSessionHasNoErrors();
    $response->assertRedirect('/');
});

test('logueado se puede crear una noticia', function () {
    $usuario = User::factory()->create();

    $response = $this
        ->actingAs($usuario)
        ->get('/peliculas/create');

    $response->assertOk();
});

test('el usuario crea una pelicula correctamente', function () {
    $usuario = User::factory()->create();

    $response = $this
        ->actingAs($usuario)
        ->from('/peliculas/create')
        ->post('/peliculas', [
            'director' => 'Director de prueba',
            'titulo' => 'Título de prueba',
            'descripcion' => 'Descripción de prueba',
            'duracion' => 120,
        ]);

    $this->assertAuthenticated();

    $this->assertDatabaseHas('peliculas', [
        'director' => 'Director de prueba',
        'duracion' => 120,
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect('/peliculas');
});

//test('el usuario crea un comentario', function () {
//    $usuario = User::factory()->create();
//   $pelicula = Pelicula::factory()->create();

//    $ficha = Ficha::create([
//        'titulo' => 'Pelicula de prueba',
//        'descripcion' => 'Descripción de prueba',
//        'fichable_id' => $pelicula->id,
//        'fichable_type' => Pelicula::class,
//    ]);

//    $response = $this
//        ->actingAs($usuario)
//        ->from('/comentario/crear/' . $ficha->id)
//        ->post('/comentarios', [
//            'texto' => 'Director de pruebas',
//        ]);

//    $this->assertAuthenticated();

//    $this->assertDatabaseHas('comentarios', [
//        'texto' => 'Director de pruebas',
//        'comentable_id' => $pelicula->id,
//        'comentable_type' => Pelicula::class,
//        'user_id' => $usuario->id
//    ]);

//    $response->assertSessionHasNoErrors();
//    $response->assertRedirect('/peliculas');
//});


