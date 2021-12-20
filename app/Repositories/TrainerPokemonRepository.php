<?php

namespace App\Repositories;

use App\Models\TrainerPokemon;

class TrainerPokemonRepository
{
    public function create($payload)
    {
        return TrainerPokemon::create($payload);
    }
}
