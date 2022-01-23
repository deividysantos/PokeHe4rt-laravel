<?php

namespace App\Providers;

use App\Repositories\TrainerPokemonRepository;
use App\Repositories\TrainerRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\ITrainerRepository', TrainerRepository::class);

        $this->app->bind('App\Repositories\ITrainerPokemonRepository', TrainerPokemonRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
