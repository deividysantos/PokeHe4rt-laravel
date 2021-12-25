<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Services\PokemonService;
use App\Services\TrainerPokemonService;
use App\Services\TrainerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\Throw_;
use PHPUnit\Exception;

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

        $this->trainerService->create($payload);

        return redirect()->route('trainer.index');
    }

    public function show($id)
    {
        $trainer = $this->trainerService->getById($id);
        $pokemons = $this->trainerService->getPokemons($id);

        $pokemons = $this->pokemonService->ucwordsMethod($pokemons, 'name');

        $types = $this->pokemonService->getTypes();

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

    public function destroy($idTrainer)
    {
        $this->trainerPokemonService->deleteTrainer($idTrainer);
        $this->trainerService->delete($idTrainer);

        return Redirect()->Route('trainer.index', $idTrainer);
    }

    public function capture(Request $request)
    {
            $namePokemon = strtolower($request['namePokemon']);

        $pokemon = $this->pokemonService->existByName($namePokemon);

        if(!$pokemon)
        {
            $this->pokemonService->create($namePokemon);
            $pokemon = $this->pokemonService->existByName($namePokemon);
        }

        if(!$pokemon)
        {
            dd('sapoha n existe');
        }

        $pokemon_id = $this->pokemonService->getByName($namePokemon)[0]->id;

        $payload = [
            'trainer_id' => $request['idTrainer'],
            'pokemon_id' => $pokemon_id
        ];

        $this->trainerPokemonService->create($payload);

        return redirect()->route('trainer.show', $request['idTrainer']);
    }

    public function drop(Request $request)
    {
        $payload = [
            'trainer_id' => $request['trainer_id'],
            'pokemon_id' => $request['pokemon_id']
        ];

        $this->trainerPokemonService->drop($payload);

        return redirect()->route('trainer.show', $request['trainer_id']);
    }

    public function ucwordsMethod($pokemons)
    {

    }
}
