<?php

namespace App\Http\Controllers\Pokemon;

use App\Repositories\TrainerPokemonRepository;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DropPokemonController extends Controller
{
    private TrainerPokemonRepository $trainerPokemonRepository;

    public function __construct(TrainerPokemonRepository $trainerPokemonRepository)
    {
         $this->trainerPokemonRepository = $trainerPokemonRepository;
    }

    public function getDropPokemon(string $trainerPokemonId)
    {
        $trainerPokemon = $this->trainerPokemonRepository->getById($trainerPokemonId);

        if($trainerPokemon['trainer_id'] != Auth::User()->id)
            return redirect()->route('myPokemonsView');

        $this->trainerPokemonRepository->dropPokemon($trainerPokemonId);

        return redirect()->route('myPokemonsView');
    }
}
