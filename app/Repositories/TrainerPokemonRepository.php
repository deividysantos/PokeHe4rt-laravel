<?php

namespace App\Repositories;

use App\Models\TrainerPokemon;

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

    public function dropPokemon($payload)
    {
        $trainerPokemon = $this->model->where('trainer_id', $payload['trainer_id'], 'and')
            ->where('pokemon_id', $payload['pokemon_id'])
            ->first();

        return $trainerPokemon->delete();
    }

    public function deleteTrainer($idTrainer)
    {
        $trainerPokemons = $this->model->where('trainer_id', $idTrainer)->get();

        $trainerPokemons->map(function ($trainerPokemon)
        {
            $trainerPokemon->delete();
        });
    }
}
