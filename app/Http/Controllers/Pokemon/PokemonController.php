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

    public function getShow(string $trainerPokemonId)
    {
        $pokemon = $this->trainerPokemonRepository->getPokemonByTrainerPokemon($trainerPokemonId);

        return view('showPokemon', compact(['pokemon', 'trainerPokemonId']));
    }

    public function postNewNickname(Request $request)
    {
        $request->validate([
            'nickNamePokemon' => 'required|string',
            'trainerPokemonId' => 'required'
        ]);

        $this->trainerPokemonRepository->editNicknamePokemon($request['trainerPokemonId'], $request['nickNamePokemon']);

        return view('myPokemons');
    }
}
