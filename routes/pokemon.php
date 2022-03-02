<?php

use App\Http\Controllers\Pokemon\CapturePokemonController;
use App\Http\Controllers\Pokemon\DropPokemonController;
use App\Http\Controllers\Pokemon\ProfilePokemonController;
use App\Http\Controllers\Pokemon\RegisterNicknameController;
use Illuminate\Support\Facades\Route;

Route::get('pokemons', function ()
{return view('myPokemons');})
    ->middleware(['auth'])
    ->name('myPokemonsView');

Route::get('pokemon/show/{trainerPokemonId}', [ProfilePokemonController::class, 'getShow'])
    ->middleware(['auth'])
    ->where('trainerPokemonId', '^[0-9]+')
    ->name('showPokemonView');

Route::get('/capture/{paginate?}', [CapturePokemonController::class, 'getCapturePokemon'])
    ->middleware(['auth'])
    ->where('paginate', '^[0-9]+')
    ->name('capturePokemonView');

Route::get('/dropPokemon/{trainerPokemonId}', [DropPokemonController::class, 'deleteDropPokemon'])
    ->middleware(['auth'])
    ->where('trainerPokemonId', '^[0-9]+')
    ->name('dropPokemon');

Route::post('/capturePokemon', [CapturePokemonController::class, 'postCapturePokemon'])
    ->middleware(['auth'])
    ->name('capturePokemon');

Route::post('pokemon/nickname', [RegisterNicknameController::class, 'postNewNickname'])
    ->middleware(['auth'])
    ->name('nicknamePokemon');
