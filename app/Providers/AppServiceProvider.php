<?php

namespace App\Providers;

use App\Models\Cadastro;
use App\Observers\CadastroObserver;
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
        //
        Cadastro::observe(CadastroObserver::class);
    }
}
