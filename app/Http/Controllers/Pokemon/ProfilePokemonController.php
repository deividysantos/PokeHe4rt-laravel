<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Controllers\Controller;
use App\Repositories\ITrainerPokemonRepository;
use App\Repositories\PokemonRepository;
use App\Services\PokemonService;
use Illuminate\Support\Facades\Auth;

class ProfilePokemonController extends Controller
{
    private ITrainerPokemonRepository $trainerPokemonRepository;
    private PokemonRepository $pokemonRepository;

    public function __construct(ITrainerPokemonRepository $trainerPokemonRepository,
                                PokemonRepository $pokemonRepository)
    {
        $this->trainerPokemonRepository = $trainerPokemonRepository;
        $this->pokemonRepository = $pokemonRepository;
    }

    public function getShow(string $trainerPokemonId)
    {
        $trainerPokemon = $this->trainerPokemonRepository->getById($trainerPokemonId);

        if($trainerPokemon['trainer_id'] != Auth::User()->id)
            return redirect()->route('myPokemonsView');

        $payload = $this->pokemonRepository->formatDataToShowPokemon($trainerPokemon->pokemon->name);

        return view('showPokemon', compact(['payload', 'trainerPokemon']));
    }
}
