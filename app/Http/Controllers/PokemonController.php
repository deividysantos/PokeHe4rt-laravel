<?php

namespace App\Http\Controllers;

use App\Services\PokemonService;
use Illuminate\Http\Request;

class PokemonController extends Controller
{

    protected PokemonService $pokemonService;

    public function __construct(PokemonService $pokeService)
    {
        $this->pokemonService = $pokeService;
    }

    public function index($idTrainer)
    {
        $pokemons = $this->pokemonService->getAll();

        return view('pokemon.index', compact('pokemons','idTrainer'));
    }

    public function Create()
    {
        return view('pokemon.create');
    }

    public function Store(Request $request)
    {
        $this->pokemonService->create($request['namePokemon']);

        return redirect()->route('trainer.index');
    }
}
