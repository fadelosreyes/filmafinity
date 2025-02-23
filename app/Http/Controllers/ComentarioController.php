<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Juego;
use App\Models\Pelicula;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class ComentarioController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('comentarios.index', [
            'comentarios' => Comentario::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comentario $comentario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentario $comentario)
    {
        Gate::authorize('delete-comentario', $comentario);

        // Elimina el comentario
        $comentario->delete();

        // Redirige a la película asociada directamente utilizando la relación
        //return redirect()->route('peliculas.show', ['pelicula' => $comentario->comentable->id]);
        //}
        $ficha = $comentario->comentable;

        if ($ficha->fichable instanceof \App\Models\Pelicula) {
            return redirect()->route('peliculas.show', ['pelicula' => $ficha->fichable->id]);
        }

        if ($ficha->fichable instanceof \App\Models\Juego) {
            return redirect()->route('juegos.show', ['juego' => $ficha->fichable->id]);
        }
    }
}
