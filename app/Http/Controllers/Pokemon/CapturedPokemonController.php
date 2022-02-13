<?php

namespace App\Http\Controllers\Pokemon;

use App\Http\Controllers\Controller;
use App\Repositories\ITrainerPokemonRepository;
use App\Repositories\PokemonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CapturedPokemonController extends Controller
{
    private PokemonRepository $pokemonRepository;
    private ITrainerPokemonRepository $trainerPokemonRepository;

    public function __construct(PokemonRepository $pokemonRepository,
                                ITrainerPokemonRepository $trainerPokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
        $this->trainerPokemonRepository = $trainerPokemonRepository;
    }

    public function postCapturePokemon(Request $request)
    {

        $request->validate(
            [
                'namePokemon' => 'required | max:255'
            ]
        );

        try{
            $this->pokemonRepository->createIfPokemonNotExist($request['namePokemon']);
        }catch (\InvalidArgumentException $e)
        {
            $messageError = $e->getMessage();
            return view('error', compact('messageError'));
        }

        $pokemon = $this->pokemonRepository->getByName($request['namePokemon']);

        $payload = [
            'nickName' => "",
            'trainer_id' => Auth::user()->id,
            'pokemon_id' => $pokemon->id
        ];

        $this->trainerPokemonRepository->create($payload);

        return redirect()->route('myPokemonsView', [Auth::user()->region, Auth::user()->name]);
    }
}
