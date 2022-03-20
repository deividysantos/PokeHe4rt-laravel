<?php

use App\Http\Controllers\LiveStream\HomeLiveStreamController;
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

Route::get('lives', [HomeLiveStreamController::class, 'home'])
    ->name('HomeLiveStream');

require __DIR__.'/auth.php';
require __DIR__.'/pokemon.php';
