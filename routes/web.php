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
    Route::get('/{id}', [TrainerController::class, 'show'])->name('trainer.show');
    Route::post('/delete', [TrainerController::class, 'destroy'])->name('trainer.destroy');
    Route::post('/store', [TrainerController::class, 'store'])->name('trainer.store');
    Route::post('/capture', [TrainerController::class, 'capture'])->name('trainer.capture');

});

Route::prefix('pokemon')->group(function()
{
    Route::get('/trainer/{id}', [PokemonController::class, 'index'])->name('pokemon.index');
    Route::get('/create', [PokemonController::class, 'create'])->name('pokemon.create');
    Route::post('/store', [PokemonController::class, 'store'])->name('pokemon.store');
});
