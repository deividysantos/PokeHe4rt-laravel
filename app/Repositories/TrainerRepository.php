<?php

namespace App\Repositories;

use App\Models\Trainer;

class TrainerRepository
{
    public function getAll()
    {
        return Trainer::all();
    }

    public function create($payload)
    {
        return Trainer::create($payload);
    }

    public function getById($id)
    {
        return Trainer::find($id);
    }

    public function getPokemons($idTrainer)
    {
        $trainer = $this->getById($idTrainer);

        return $trainer->pokemons;
    }
}
