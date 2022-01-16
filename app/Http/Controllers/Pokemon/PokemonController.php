<?php

namespace App\Http\Controllers\Pokemon;

use App\Repositories\PokemonRepository;
use App\Repositories\TrainerPokemonRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use function redirect;
use function view;

class PokemonController extends Controller
{

    protected PokemonRepository $pokemonRepository;
    protected TrainerPokemonRepository $trainerPokemonRepository;

    public function __construct(PokemonRepository $pokemonRepository,
                                TrainerPokemonRepository $trainerPokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
        $this->trainerPokemonRepository = $trainerPokemonRepository;
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

    public function show(string $trainerPokemonId)
    {
        $pokemon = $this->trainerPokemonRepository->getPokemonId($trainerPokemonId);

        return view('showPokemon', compact(['pokemon', 'trainerPokemonId']));
    }

    public function Store(Request $request)
    {
        $this->pokemonRepository->create(strtolower($request['namePokemon']));

        return redirect()->route('trainer.index');
    }

    public function postNewNickName(Request $request)
    {
        $request->validate([
            'nickNamePokemon' => 'required|string',
            'trainerPokemonId' => 'required'
        ]);

        $this->trainerPokemonRepository->editNickNamePokemon($request['trainerPokemonId'], $request['nickNamePokemon']);

        return view('myPokemons');
    }
}
