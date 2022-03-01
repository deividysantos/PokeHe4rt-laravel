<?php

namespace App\Http\Controllers\Pokemon;

use App\Repositories\Contracts\ITrainerPokemonRepository;
use App\Repositories\Eloquent\TrainerPokemonRepositoryEloquent;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DropPokemonController extends Controller
{
    public function __construct(
        private ITrainerPokemonRepository $trainerPokemonRepository)
    {
    }

    public function deleteDropPokemon(string $trainerPokemonId)
    {
        $trainerPokemon = $this->trainerPokemonRepository->getById($trainerPokemonId);

        if(!$trainerPokemon || $trainerPokemon['trainer_id'] !== Auth::User()->id)
            return redirect()->route('myPokemonsView');

        $this->trainerPokemonRepository->dropPokemon($trainerPokemonId);

        return redirect()->route('myPokemonsView');
    }
}
