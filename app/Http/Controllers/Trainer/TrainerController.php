<?php

namespace App\Http\Controllers\Trainer;

use App\Repositories\PokemonRepository;
use App\Repositories\TrainerPokemonRepository;
use App\Repositories\TrainerRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

class TrainerController extends Controller
{
    private TrainerRepository $trainerRepository;
    private PokemonRepository $pokemonRepository;
    private TrainerPokemonRepository $trainerPokemonRepository;

    public function __construct(TrainerRepository $trainerRepository,
                                PokemonRepository $pokemonRepository,
                                TrainerPokemonRepository $trainerPokemonRepository)
    {
        $this->trainerRepository = $trainerRepository;
        $this->pokemonRepository = $pokemonRepository;
        $this->trainerPokemonRepository = $trainerPokemonRepository;
    }

    public function postDelete()
    {
        $idTrainer = Auth::user()->id;
        $this->trainerPokemonRepository->deletePokemonsByTrainer($idTrainer);
        $this->trainerRepository->delete($idTrainer);

        return Redirect()->Route('site.home');
    }

    public function postCapturePokemon(Request $request)
    {
        try{
            $this->pokemonRepository->create($request['namePokemon']);
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

    public function postDropPokemon(string $trainerPokemonId)
    {
        $trainerPokemon = $this->trainerPokemonRepository->getById($trainerPokemonId);

        if($trainerPokemon['trainer_id'] != Auth::User()->id)
            return redirect()->route('myPokemonsView');

        $this->trainerPokemonRepository->dropPokemon($trainerPokemonId);

        return redirect()->route('myPokemonsView');
    }
}
