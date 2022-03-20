<?php

namespace App\Http\Controllers\Pokemon;

use App\Repositories\Contracts\IPokemonTrainerRepository;
use App\Http\Controllers\Controller;
use App\Models\PokemonTrainer;

class DropPokemonController extends Controller
{
    public function __construct(
        private IPokemonTrainerRepository $pokemonTrainerRepository)
    {
    }

    public function deleteDropPokemon(PokemonTrainer $pokemonTrainer)
    {
        if(!$this->authorize('pokemonsBelongsToTrainer', $pokemonTrainer))
            return redirect()->route('myPokemonsView');

        $this->pokemonTrainerRepository->dropPokemon($pokemonTrainer->id);

        return redirect()->route('myPokemonsView');
    }
}
