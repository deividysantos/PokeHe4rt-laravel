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

Route::prefix('trainer')->group(function(){
    Route::get('/create', [TrainerController::class, 'getCreate'])->name('trainer.viewCreate');
    Route::get('/{region}/{name}', [TrainerController::class, 'getProfile'])->name('trainer.profile');

    Route::post('/create', [TrainerController::class, 'postCreate'])->name('trainer.apiCreate');
    Route::delete('/delete/{id}', [TrainerController::class, 'postDelete'])->name('trainer.delete');
    Route::post('/drop', [TrainerController::class, 'postDropPokemon'])->name('trainer.dropPokemon');
    Route::post('/capture', [TrainerController::class, 'postCapturePokemon'])->name('trainer.capturePokemon');
});

Route::get('{idTrainer}/Pokemon/show/{namePokemon}', [PokemonController::class, 'show'])->name('pokemon.show');
Route::prefix('pokemon')->group(function()
{
    Route::get('/trainer/{id}', [PokemonController::class, 'index'])->name('pokemon.index');
    Route::post('/store', [PokemonController::class, 'store'])->name('pokemon.store');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
