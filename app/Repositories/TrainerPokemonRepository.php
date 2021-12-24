<?php

namespace App\Repositories;

use App\Models\TrainerPokemon;

class TrainerPokemonRepository
{
    public function create($payload)
    {
        return TrainerPokemon::create($payload);
    }

    public function dropPokemon($payload)
    {
        $trainerPokemon = TrainerPokemon::where('trainer_id', $payload['trainer_id'], 'and')
            ->where('pokemon_id', $payload['pokemon_id'])
            ->first();

        return $trainerPokemon->delete();
    }

    public function deleteTrainer($idTrainer)
    {
        $trainerPokemons = TrainerPokemon::where('trainer_id', $idTrainer)->get();

        foreach ($trainerPokemons as $trainerPokemon)
        {
            $trainerPokemon->delete();
        }

        return true;
    }
}
