<?php

namespace App\Http\Controllers\Pokemon;

use App\Repositories\Contracts\ITrainerPokemonRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RegisteredNicknameController extends Controller
{
    private ITrainerPokemonRepository $trainerPokemonRepository;

    public function __construct(ITrainerPokemonRepository $trainerPokemonRepository)
    {
        $this->trainerPokemonRepository = $trainerPokemonRepository;
    }

    public function postNewNickname(Request $request)
    {
        $request->validate([
            'nicknamePokemon' => 'required| max:20',
            'trainerPokemonId' => 'required'
        ]);

        $this->trainerPokemonRepository->editNicknamePokemon($request['trainerPokemonId'], $request['nicknamePokemon']);

        return redirect()->route('myPokemonsView');
    }
}
