<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Requests\RegisterNicknameRequest;
use App\Repositories\Contracts\IPokemonTrainerRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class RegisterNicknameController extends Controller
{

    public function __construct(
        private IPokemonTrainerRepository $pokemonTrainerRepository
    )
    {
    }

    public function postNewNickname(RegisterNicknameRequest $request): RedirectResponse
    {
        $this->pokemonTrainerRepository->editNicknamePokemon($request['pokemonTrainerId'], $request['nicknamePokemon']);

        return redirect()->route('myPokemonsView');
    }
}
