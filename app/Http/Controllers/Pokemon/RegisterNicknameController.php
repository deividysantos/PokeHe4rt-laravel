<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Requests\RegisterNicknameRequest;
use App\Repositories\Contracts\ITrainerPokemonRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RegisterNicknameController extends Controller
{
    private ITrainerPokemonRepository $trainerPokemonRepository;

    public function __construct(ITrainerPokemonRepository $trainerPokemonRepository)
    {
        $this->trainerPokemonRepository = $trainerPokemonRepository;
    }

    public function postNewNickname(RegisterNicknameRequest $request)
    {
        $this->trainerPokemonRepository->editNicknamePokemon($request['trainerPokemonId'], $request['nicknamePokemon']);

        return redirect()->route('myPokemonsView');
    }
}
