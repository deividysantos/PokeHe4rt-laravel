<?php

namespace App\Http\Controllers\Pokemon;

use App\Exceptions\PokemonNameNotExist;
use App\Http\Controllers\Controller;
use App\Http\Requests\CapturedPokemonRequest;
use App\Repositories\Contracts\IPokemonRepository;
use App\Repositories\Contracts\ITrainerPokemonRepository;
use App\Services\Contract\IPokemonService;
use Illuminate\Support\Facades\Auth;

class CapturedPokemonController extends Controller
{
    public function __construct(
        private IPokemonService $pokemonService,
        private IPokemonRepository $pokemonRepository,
        private ITrainerPokemonRepository $trainerPokemonRepository
    )
    {
    }

    public function postCapturePokemon(CapturedPokemonRequest $request)
    {
        $this->pokemonService->create($request['pokemonName']);

        $pokemon = $this->pokemonRepository->getByName($request['pokemonName']);

        $payload = [
            'nickName' => '',
            'trainer_id' => Auth::user()->id,
            'pokemon_id' => $pokemon->id
        ];

        $this->trainerPokemonRepository->create($payload);

        return redirect()->route('myPokemonsView');
    }
}
