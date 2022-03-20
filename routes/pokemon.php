<?php

use App\Http\Controllers\Pokemon\CapturePokemonController;
use App\Http\Controllers\Pokemon\DropPokemonController;
use App\Http\Controllers\Pokemon\ProfilePokemonController;
use App\Http\Controllers\Pokemon\RegisterNicknameController;
use Illuminate\Support\Facades\Route;
Route::middleware('auth')->group(function (){
    Route::get('pokemons', function ()
    {
        return view('myPokemons');
    })->name('myPokemonsView');

    Route::get('pokemon/show/{pokemonTrainer}', [ProfilePokemonController::class, 'getShow'])
        ->name('showPokemonView');

    Route::get('/capture/{paginate?}', [CapturePokemonController::class, 'getCapturePokemon'])
        ->where('paginate', '^[0-9]+')
        ->name('capturePokemonView');

    Route::get('/dropPokemon/{pokemonTrainer}', [DropPokemonController::class, 'deleteDropPokemon'])
        ->name('dropPokemon');

    Route::post('/capturePokemon', [CapturePokemonController::class, 'postCapturePokemon'])
        ->name('capturePokemon');

    Route::post('pokemon/nickname', [RegisterNicknameController::class, 'postNewNickname'])
        ->name('nicknamePokemon');

});
