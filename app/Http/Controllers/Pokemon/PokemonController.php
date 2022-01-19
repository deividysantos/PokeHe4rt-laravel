<?php

namespace App\Http\Controllers\Pokemon;

use App\Repositories\PokemonRepository;
use App\Repositories\TrainerPokemonRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Diff\Exception;
use function redirect;
use function view;

class PokemonController extends Controller
{

    protected PokemonRepository $pokemonRepository;
    protected TrainerPokemonRepository $trainerPokemonRepository;

    public function __construct(PokemonRepository $pokemonRepository,
                                TrainerPokemonRepository $trainerPokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
        $this->trainerPokemonRepository = $trainerPokemonRepository;
    }

    public function getShow(string $trainerPokemonId)
    {
        $trainerPokemon = $this->trainerPokemonRepository->getById($trainerPokemonId);

        if($trainerPokemon['trainer_id'] != Auth::User()->id)
                return redirect()->route('myPokemonsView');

        $payload = $this->pokemonRepository->formatDataToShowPokemon($trainerPokemon->pokemon->name);

        return view('showPokemon', compact(['payload', 'trainerPokemon']));
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
