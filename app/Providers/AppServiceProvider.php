<?php

namespace App\Providers;

use App\Http\Livewire\IndexPelicula;
use App\Models\Comentario;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('delete-comentario', function (User $user, Comentario $comentario) {
            return $user->id === $comentario->user_id;
        });

        Livewire::component('index-pelicula', IndexPelicula::class);
    }
}
