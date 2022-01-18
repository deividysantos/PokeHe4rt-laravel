<?php

use App\Http\Controllers\Pokemon\PokemonController;
use App\Http\Controllers\Trainer\TrainerController;
use Illuminate\Support\Facades\Route;

Route::get('pokemons', [TrainerController::class, 'getMyPokemons'])
    ->middleware(['auth'])
    ->name('myPokemonsView');

Route::get('pokemon/show/{trainerPokemonId}', [PokemonController::class, 'getShow'])
    ->middleware(['auth'])
    ->where('trainerPokemonId', '[1-9]+')
    ->name('showPokemonView');

Route::get('/capture', function (){
    return view('capturePokemon');})
    ->middleware(['auth'])
    ->name('capturePokemonView');

Route::get('/dropPokemon/{trainerPokemonId}', [TrainerController::class, 'postDropPokemon'])
    ->middleware(['auth'])
    ->where('trainerPokemonId', '[1-9]+')
    ->name('dropPokemon');

Route::post('/capturePokemon', [TrainerController::class, 'postCapturePokemon'])
    ->middleware(['auth'])
    ->name('capturePokemon');

Route::post('pokemon/nickname', [PokemonController::class, 'postNewNickname'])
    ->middleware(['auth'])
    ->name('nickNamePokemon');
