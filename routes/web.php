<?php

use App\Http\Controllers\FichaController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\ProfileController;
use App\Models\Pelicula;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('peliculas', PeliculaController::class);
Route::resource('juegos', JuegoController::class);
Route::resource('fichas', FichaController::class);

require __DIR__.'/auth.php';
