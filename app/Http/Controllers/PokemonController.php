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

    public function getMyPokemons()
    {
        return view('myPokemons');
    }

    public function index($idTrainer)
    {
        $pokemons = $this->pokemonRepository->getAll();

        $pokemons->map(function ($pokemon){
            $pokemon->name = ucfirst($pokemon->name);
        });

        $types = $this->pokemonRepository->getTypes();

        return view('app.pokemon.pokemonIndex', compact([
            'pokemons',
            'idTrainer',
            'types'])
        );
    }

    public function show(string $namePokemon)
    {
        $pokemonInfo = $this->pokemonRepository->getDataPokemon(strtolower($namePokemon));

        foreach ($pokemonInfo->types as $type)
        {
            $types[] = ucfirst($type->type->name);
        }

        $pokemon = [
            'name' => ucfirst($pokemonInfo->name),
            'types' => $types,
            'countTypes' => count($types),
            'image_url' => $pokemonInfo->sprites->front_default,
            'weight' => $pokemonInfo->weight,
            'height' => $pokemonInfo->height
        ];
        return redirect('https://www.pokemon.com/br/pokedex/' . $pokemonInfo->name);
    }

    public function Store(Request $request)
    {
        $this->pokemonRepository->create(strtolower($request['namePokemon']));

        return redirect()->route('trainer.index');
    }
}
