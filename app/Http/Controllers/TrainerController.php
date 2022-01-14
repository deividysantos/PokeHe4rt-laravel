<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Repositories\PokemonRepository;
use App\Repositories\TrainerPokemonRepository;
use App\Repositories\TrainerRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

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

    public function getCreate()
    {
        return view('app.trainer.trainerCreate');
    }

    public function getProfile(string $region, string $name)
    {
        $trainer = $this->trainerRepository->getByRegionAndName($region, $name)[0];
        $pokemons = $this->trainerRepository->getPokemons($trainer->id);

        $pokemons->map(function ($pokemon){
            $pokemon->name = ucfirst($pokemon->name);
        });

        $types = $this->pokemonRepository->getTypes();

        return view('app.trainer.trainerShow', compact(['trainer', 'pokemons', 'types']));
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'region' => 'required',
            'age' => 'required|numeric'
        ]);

        $payload = [
            'name' => $request['name'],
            'region' => $request['region'],
            'age' => $request['age']
        ];

        if(!$this->trainerRepository->create($payload)){
            $messageError = 'Trainer already registered';
            return view('error', compact('messageError'));
        }


        return redirect()->route('trainer.index');
    }

    public function postDelete($idTrainer)
    {
        $this->trainerPokemonRepository->deletePokemonsByTrainer($idTrainer);
        $this->trainerRepository->delete($idTrainer);

        return Redirect()->Route('trainer.index', $idTrainer);
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
            'trainer_id' => $request['idTrainer'],
            'pokemon_id' => $pokemon[0]->id
        ];

        $this->trainerPokemonRepository->create($payload);

        $trainer = $this->trainerRepository->getById($request['idTrainer']);

        return redirect()->route('trainer.profile', [$trainer->region, $trainer->name]);
    }

    public function postDropPokemon(Request $request)
    {
        $this->trainerPokemonRepository->dropPokemon($request['trainer_id'], $request['pokemon_id']);

        $trainer = $this->trainerRepository->getById($request['trainer_id']);

        return redirect()->route('trainer.profile', [$trainer->region, $trainer->name]);
    }
}
