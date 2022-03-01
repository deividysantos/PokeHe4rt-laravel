<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ITrainerPokemonRepository;
use App\Services\Contract\IPokemonService;
use Illuminate\Support\Facades\Auth;

class ProfilePokemonController extends Controller
{
    public function __construct(
        private IPokemonService $pokemonService,
        private ITrainerPokemonRepository $trainerPokemonRepository,
    )
    {
    }

    public function getShow(string $trainerPokemonId)
    {
        $trainerPokemon = $this->trainerPokemonRepository->getById($trainerPokemonId);

        if($trainerPokemon['trainer_id'] != Auth::User()->id)
            return redirect()->route('myPokemonsView');

        $payload = $this->pokemonService->formatDataToShowPokemon($trainerPokemon->pokemon->name);

        return view('showPokemon', compact(['payload', 'trainerPokemon']));
    }
}
