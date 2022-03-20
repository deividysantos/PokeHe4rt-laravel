<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapturedPokemonRequest;
use App\Repositories\Contracts\IPokemonRepository;
use App\Repositories\Contracts\IPokemonTrainerRepository;
use App\Services\Contract\IPokemonService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CapturePokemonController extends Controller
{
    public function __construct(
        private IPokemonService $pokemonService,
        private IPokemonRepository $pokemonRepository,
        private IPokemonTrainerRepository $pokemonTrainerRepository
    )
    {
    }

    public function getCapturePokemon($paginate = 1): View
    {
        $pokemons = $this->pokemonRepository->getPaginate($paginate);

        return view('capturePokemon', compact(['pokemons', 'paginate']));
    }

    public function postCapturePokemon(CapturedPokemonRequest $request): RedirectResponse
    {
        $this->pokemonService->createByName($request['pokemonName']);

        $pokemon = $this->pokemonRepository->getByName($request['pokemonName']);

        $payload = [
            'nickName' => '',
            'trainer_id' => Auth::user()->id,
            'pokemon_id' => $pokemon->id
        ];

        $this->pokemonTrainerRepository->create($payload);

        return redirect()->route('myPokemonsView');
    }
}
