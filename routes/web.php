<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\PeliculaController;
use App\Models\Comentario;
use App\Models\Ficha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

use App\Http\Controllers\ProfileController;
use App\Models\Pelicula;

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


Route::resource('fichas', FichaController::class);
Route::resource('peliculas', PeliculaController::class)->middleware(['auth']);
Route::resource('juegos', JuegoController::class);
Route::resource('comentarios', ComentarioController::class);

Route::post('/comentario/crear/{ficha}', function (Request $request, Ficha $ficha) {

    $validated = $request->validate([
        'texto' => 'nullable|string|max:255',
    ]);

    DB::beginTransaction();
    $user_id = Auth::user()->id;

    $comentario = new Comentario([
        'texto' => $validated['texto'],
        'user_id' => $user_id
    ]);

    $comentario->comentable()->associate($ficha);
    $comentario->save();
    DB::commit();
    if($ficha->fichable::class == "App\Models\Pelicula"){

        return redirect()->route('peliculas.show', [
            'pelicula' => $ficha->fichable,
        ]);

        // return back();
    }
})->name('comentario.crear');

Route::get('/inicio', function () {
    return view('inicio.peliculas', [
        'peliculas' => Pelicula::paginate(8),
    ]);
})->name('inicio.peliculas');



