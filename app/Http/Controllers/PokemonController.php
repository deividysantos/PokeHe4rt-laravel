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

        $pokemons = $this->pokemonService->ucwordsMethod($pokemons, 'name');

        $types = $this->pokemonService->getTypes();

        return view('pokemon.pokemonIndex', compact([
            'pokemons',
            'idTrainer',
            'types']));
    }

    public function show($idTrainer, $name)
    {
        $pokemonInfos = $this->pokemonService->getDataPokemon(strtolower($name));

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

        return view('pokemon.pokemonShow', compact(['pokemon', 'idTrainer']));
    }

    public function Store(Request $request)
    {
        $this->pokemonService->create(strtolower($request['namePokemon']));

        return redirect()->route('trainer.index');
    }
}
