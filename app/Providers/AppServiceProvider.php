<?php

namespace App\Providers;

use App\Models\Comentario;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
    }
}
