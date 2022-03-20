<?php

namespace App\Http\Controllers\Pokemon;

use App\Services\Contract\IPokemonService;
use App\Http\Controllers\Controller;
use App\Models\PokemonTrainer;

class ProfilePokemonController extends Controller
{
    public function __construct(
        private IPokemonService $pokemonService,
    )
    {
    }

    public function getShow(PokemonTrainer $pokemonTrainer)
    {
        if(!$this->authorize('pokemonsBelongsToTrainer', $pokemonTrainer))
            return redirect()->route('myPokemonsView');

        $payload = $this->pokemonService->formatDataToShowPokemon($pokemonTrainer->pokemon->name);

        return view('showPokemon', compact(['payload', 'pokemonTrainer']));
    }
}
