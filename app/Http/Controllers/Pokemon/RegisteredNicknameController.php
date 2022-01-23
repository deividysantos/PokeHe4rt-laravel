<?php

namespace App\Http\Controllers\Pokemon;

use App\Repositories\ITrainerPokemonRepository;
use App\Repositories\PokemonRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

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
            'nicknamePokemon' => 'required|string',
            'trainerPokemonId' => 'required'
        ]);

        $this->trainerPokemonRepository->editNicknamePokemon($request['trainerPokemonId'], $request['nicknamePokemon']);

        return redirect()->route('myPokemonsView');
    }
}
