<?php

namespace App\Http\Controllers\Pokemon;

use App\Repositories\PokemonRepository;
use App\Repositories\TrainerPokemonRepository;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use function redirect;

class DropPokemonController extends Controller
{
    private TrainerPokemonRepository $trainerPokemonRepository;

    public function __construct(TrainerPokemonRepository $trainerPokemonRepository)
    {
         $this->trainerPokemonRepository = $trainerPokemonRepository;
    }

    public function postDropPokemon(string $trainerPokemonId)
    {
        $trainerPokemon = $this->trainerPokemonRepository->getById($trainerPokemonId);

        if($trainerPokemon['trainer_id'] != Auth::User()->id)
            return redirect()->route('myPokemonsView');

        $this->trainerPokemonRepository->dropPokemon($trainerPokemonId);

        return redirect()->route('myPokemonsView');
    }
}
