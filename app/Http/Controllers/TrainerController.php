<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Services\PokemonService;
use App\Services\TrainerPokemonService;
use App\Services\TrainerService;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    private TrainerService $trainerService;
    private PokemonService $pokemonService;
    private TrainerPokemonService $trainerPokemonService;

    public function __construct(TrainerService $trainerService,
                                PokemonService $pokemonService,
                                TrainerPokemonService $trainerPokemonService)
    {
        $this->trainerService = $trainerService;
        $this->pokemonService = $pokemonService;
        $this->trainerPokemonService = $trainerPokemonService;
    }

    public function index()
    {
        $trainers = $this->trainerService->getAll();

        

        return view('trainer.index', compact(['trainers']));
    }

    public function create()
    {
        return view('trainer.create');
    }

    public function store(Request $request)
    {
        $payload = [
            'name' => $request['name'],
            'region' => $request['region'],
            'age' => $request['age']
        ];

        $this->trainerService->create($payload);

        return redirect()->route('trainer.index');
    }

    public function show($id)
    {
        $trainer = $this->trainerService->getById($id);
        $pokemons = $this->trainerService->getPokemons($id);

        return view('trainer.show', compact(['trainer', 'pokemons']));
    }

    public function edit(Trainer $trainer)
    {
        //
    }

    public function update(Request $request, Trainer $trainer)
    {
        //
    }

    public function destroy(Request $request)
    {
        //
    }

    public function capture(Request $request)
    {
        $pokemon = $this->pokemonService->existByName($request['namePokemon']);

        if(!$pokemon)
        {
            dd('Pokemon ainda nao cadastrado!');
        }

        $pokemon_id = $this->pokemonService->getByName($request['namePokemon'])[0]->id;

        $payload = [
            'trainer_id' => $request['idTrainer'],
            'pokemon_id' => $pokemon_id
        ];

        $this->trainerPokemonService->create($payload);

        return redirect()->route('trainer.show', $request['idTrainer']);
    }
}
