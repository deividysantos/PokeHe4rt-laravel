<?php

namespace App\Http\Controllers;

use App\Repositories\PokemonRepository;
use Illuminate\Http\Request;

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

        $pokemons = $this->pokemonRepository->ucwordsMethod($pokemons, 'name');

        $types = $this->pokemonRepository->getTypes();

        return view('pokemon.pokemonIndex', compact([
            'pokemons',
            'idTrainer',
            'types']));
    }

    public function show($idTrainer, $name)
    {
        $pokemonInfos = $this->pokemonRepository->getDataPokemon(strtolower($name));

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
        $this->pokemonRepository->create(strtolower($request['namePokemon']));

        return redirect()->route('trainer.index');
    }
}
