<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Repositories\PokemonRepository;
use App\Repositories\TrainerPokemonRepository;
use App\Repositories\TrainerRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

    public function index()
    {
        $trainers = $this->trainerRepository->getAll();

        return view('trainer.trainerIndex', compact(['trainers']));
    }

    public function create()
    {
        return view('trainer.trainerCreate');
    }

    public function store(Request $request)
    {
        $payload = [
            'name' => $request['name'],
            'region' => $request['region'],
            'age' => $request['age']
        ];

        $this->trainerRepository->create($payload);

        return redirect()->route('trainer.index');
    }

    public function show($id)
    {
        $trainer = $this->trainerRepository->getById($id);
        $pokemons = $this->trainerRepository->getPokemons($id);

        $pokemons->map(function ($pokemon){
            $pokemon->name = ucfirst($pokemon->name);
        });

        $types = $this->pokemonRepository->getTypes();

        return view('trainer.trainerShow', compact(['trainer', 'pokemons', 'types']));
    }

    public function edit(Trainer $trainer)
    {
        //
    }

    public function update(Request $request, Trainer $trainer)
    {
        //
    }

    public function destroy($idTrainer):RedirectResponse
    {
        $this->trainerPokemonRepository->deleteTrainer($idTrainer);
        $this->trainerRepository->delete($idTrainer);

        return Redirect()->Route('trainer.index', $idTrainer);
    }

    public function capture(Request $request)
    {
        $namePokemon = strtolower($request['namePokemon']);

        $pokemonExist = $this->pokemonRepository->existByName($namePokemon);

        if(!$pokemonExist)
        {
            $this->pokemonRepository->create($namePokemon);
            $pokemon = $this->pokemonRepository->existByName($namePokemon);
        }

        if(!$pokemonExist)
        {
            dd('sapoha n existe');
        }

        $pokemon_id = $this->pokemonRepository->getByName($namePokemon)[0]->id;

        $payload = [
            'trainer_id' => $request['idTrainer'],
            'pokemon_id' => $pokemon_id
        ];

        $this->trainerPokemonRepository->create($payload);

        return redirect()->route('trainer.show', $request['idTrainer']);
    }

    public function drop(Request $request)
    {
        $payload = [
            'trainer_id' => $request['trainer_id'],
            'pokemon_id' => $request['pokemon_id']
        ];

        $this->trainerPokemonRepository->dropPokemon($payload);

        return redirect()->route('trainer.show', $request['trainer_id']);
    }
}
