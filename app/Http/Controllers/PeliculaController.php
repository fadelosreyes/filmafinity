<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('peliculas.index', [
            'peliculas' => Pelicula::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('peliculas.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'director' => 'required',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required',
            'duracion' => 'required',
        ]);
        //dd($request->all());

        DB::beginTransaction();

        $pelicula = Pelicula::create([
            'director' => $validated['director'],
            'duracion' => $validated['duracion'],
        ]);

        $ficha = new Ficha([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
        ]);

        $ficha->fichable()->associate($pelicula);
        $ficha->save();
        DB::commit();
        session()->flash('exito', 'Pelicula creado correctamente.');
        return redirect()->route('peliculas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelicula $pelicula)
    {
        return view('peliculas.show', [
            'pelicula'  => $pelicula,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelicula $pelicula)
    {
        return view('peliculas.edit', [
            'pelicula'  => $pelicula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        $validated = $request->validate([
            'director' => 'required',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required',
            'duracion' => 'required',
        ]);
        //dd($request->all());

        DB::beginTransaction();
        $pelicula->update([
            'director' => $validated['director'],
            'duracion' => $validated['duracion'],
        ]);

        $pelicula->ficha->update([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
        ]);
        DB::commit();
        session()->flash('exito', 'pelicula modificado correctamente.');
        return redirect()->route('peliculas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelicula $pelicula)
    {
        $pelicula->ficha->delete();
        $pelicula->delete();
        return redirect()->route('peliculas.index');
    }
}
