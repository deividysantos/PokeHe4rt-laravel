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
Route::get('/', function ()
{
    return redirect()->route('trainer.index');
});

Route::prefix('trainer')->group(function(){
    Route::get('/', [TrainerController::class, 'index'])->name('trainer.index');
    Route::get('/create', [TrainerController::class, 'create'])->name('trainer.create');
    Route::get('/delete/{id}', [TrainerController::class, 'destroy'])->name('trainer.destroy');
    Route::get('/{id}', [TrainerController::class, 'show'])->name('trainer.show');
    Route::post('/drop', [TrainerController::class, 'drop'])->name('trainer.drop');
    Route::post('/store', [TrainerController::class, 'store'])->name('trainer.store');
    Route::post('/capture', [TrainerController::class, 'capture'])->name('trainer.capture');
});

Route::get('{idTrainer}/Pokemon/show/{namePokemon}', [PokemonController::class, 'show'])->name('pokemon.show');
Route::prefix('pokemon')->group(function()
{
    Route::get('/trainer/{id}', [PokemonController::class, 'index'])->name('pokemon.index');
    Route::post('/store', [PokemonController::class, 'store'])->name('pokemon.store');

});
