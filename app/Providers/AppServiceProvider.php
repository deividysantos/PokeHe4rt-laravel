<?php

namespace App\Providers;

use App\Repositories\Contracts\IPokemonRepository;
use App\Repositories\Contracts\ITrainerPokemonRepository;
use App\Repositories\Contracts\ITrainerRepository;
use App\Repositories\Eloquent\PokemonRepositoryEloquent;
use App\Repositories\Eloquent\TrainerPokemonRepositoryEloquent;
use App\Repositories\Eloquent\TrainerRepositoryEloquent;
use App\Services\Contract\IPokemonService;
use App\Services\Implementations\PokemonService;
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
        //Repositories
        $this->app->bind(ITrainerRepository::class, TrainerRepositoryEloquent::class);
        $this->app->bind(ITrainerPokemonRepository::class, TrainerPokemonRepositoryEloquent::class);
        $this->app->bind(IPokemonRepository::class, PokemonRepositoryEloquent::class);

        //Services
        $this->app->bind(IPokemonService::class, PokemonService::class);
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
