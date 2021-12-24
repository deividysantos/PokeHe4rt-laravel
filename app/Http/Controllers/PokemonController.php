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

        foreach ($pokemons as $key => $pokemon)
        {
            $pokemons[$key]->name = ucwords($pokemon->name);
        }


        return view('pokemon.pokemonIndex', compact('pokemons','idTrainer'));
    }

    public function Show($idTrainer, $name)
    {
        $pokemonInfos = $this->pokemonService->getDataPokemon($name);

        $types = [];

        foreach ($pokemonInfos->types as $type)
        {
            $types[] = ucfirst($type->type->name);
        }

        $pokemon = [
            'name' => ucfirst($pokemonInfos->name),
            'type' => $types,
            'countTypes' => count($types),
            'image_url' => $pokemonInfos->sprites->front_default,
            'weight' => $pokemonInfos->weight,
            'height' => $pokemonInfos->height
        ];

        return view('pokemon.pokemonShow', compact('pokemon', 'idTrainer'));
    }

    public function Create()
    {
        return view('pokemon.pokemonCreate');
    }

    public function Store(Request $request)
    {
        $this->pokemonService->create(strtolower($request['namePokemon']));

        return redirect()->route('trainer.index');
    }
}
