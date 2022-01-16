<?php

use App\Http\Controllers\PokemonController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;
use PhpParser\Builder\Trait_;

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
    return view('site.homepage');
})->name('site.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('pokemons', [PokemonController::class, 'getMyPokemons'])->name('myPokemons');
Route::get('pokemon/show/{namePokemon}', [PokemonController::class, 'show'])->name('pokemon.show');
Route::get('/capture', function (){
    return view('capturePokemon');
})->name('capturePokemonView');

Route::get('/dropPokemon/{pokemonId}', [TrainerController::class, 'postDropPokemon'])->name('dropPokemon');
Route::post('/capturePokemon', [TrainerController::class, 'postCapturePokemon'])->name('capturePokemon');


require __DIR__.'/auth.php';
