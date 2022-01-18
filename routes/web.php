<?php

use App\Http\Controllers\Pokemon\PokemonController;
use App\Http\Controllers\Trainer\TrainerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    return view('home');
})->name('site.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('pokemons', [TrainerController::class, 'getMyPokemons'])->middleware(['auth'])->name('myPokemons');
Route::get('pokemon/show/{trainerPokemonId}', [PokemonController::class, 'show'])->where('trainerPokemonId', '[1-9]+')->name('pokemon.show');
Route::get('/capture', function (){
    return view('capturePokemon');
})->middleware(['auth'])->name('capturePokemonView');

Route::get('/dropPokemon/{pokemonId}', [TrainerController::class, 'postDropPokemon'])->middleware(['auth'])->name('dropPokemon');

Route::post('/capturePokemon', [TrainerController::class, 'postCapturePokemon'])->middleware(['auth'])->name('capturePokemon');
Route::post('pokemon/nickname', [PokemonController::class, 'postNewNickName'])->middleware(['auth'])->name('nickNamePokemon');

require __DIR__.'/auth.php';
