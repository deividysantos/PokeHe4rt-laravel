<?php

namespace App\Repositories;

use App\Models\TrainerPokemon;
use Illuminate\Support\Facades\DB;

class TrainerPokemonRepository
{
    protected TrainerPokemon $model;

    public function __construct(TrainerPokemon $model)
    {
        $this->model = $model;
    }

    public function create($payload)
    {
        return $this->model->create($payload);
    }

    public function dropPokemon(int $trainerId, int $pokemonId):bool
    {
        $trainerPokemon = $this->model->where('trainer_id', $trainerId, 'and')
            ->where('pokemon_id', $pokemonId)
            ->first();

        return $trainerPokemon->delete();
    }

    public function deletePokemonsByTrainer(int $idTrainer)
    {
        $trainerPokemons = $this->model->where('trainer_id', $idTrainer)->get();

        $trainerPokemons->map(function ($trainerPokemon)
        {
            $trainerPokemon->delete();
        });
    }

    public function getPokemonId(string $trainerPokemonId)
    {
        return $this->model->find($trainerPokemonId);
    }

    public function editNickNamePokemon(string $trainerPokemonId, string $nickName)
    {
        $trainerPokemon = $this->model->find($trainerPokemonId);

        $trainerPokemon->nickName = $nickName;

        $trainerPokemon->save();
    }
}
