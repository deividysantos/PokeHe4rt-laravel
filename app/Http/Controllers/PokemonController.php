<?php

namespace App\Http\Controllers;

use App\Repositories\PokemonRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PokemonController extends Controller
{

    protected PokemonRepository $pokemonRepository;

    public function __construct(PokemonRepository $pokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function index($idTrainer)
    {
        $pokemons = $this->pokemonRepository->getAll();

        $pokemons = $this->pokemonRepository->ucfirstMethod($pokemons, 'name');

        $types = $this->pokemonRepository->getTypes();

        return view('pokemon.pokemonIndex', compact([
            'pokemons',
            'idTrainer',
            'types'])
        );
    }

    public function show($idTrainer, $namePokemon)
    {
        $pokemonInfo = $this->pokemonRepository->getDataPokemon(strtolower($namePokemon));

        $types = $pokemonInfo->map(function ($item)
        {
            return ucfirst($item->type->name);
        });

        $pokemon = [
            'name' => ucfirst($pokemonInfo->name),
            'type' => $types,
            'countTypes' => count($types),
            'image_url' => $pokemonInfo->sprites->front_default,
            'weight' => $pokemonInfo->weight,
            'height' => $pokemonInfo->height
        ];

        return view('pokemon.pokemonShow', compact(['pokemon', 'idTrainer']));
    }

    public function Store(Request $request)
    {
        $this->pokemonRepository->create(strtolower($request['namePokemon']));

        return redirect()->route('trainer.index');
    }
}
