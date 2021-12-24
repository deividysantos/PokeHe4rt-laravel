<?php

namespace App\Services;

use App\Repositories\TrainerPokemonRepository;

class TrainerPokemonService
{
    private TrainerPokemonRepository $trainerPokemonRepository;

    public function __construct(TrainerPokemonRepository $trainerPokemonRepository)
    {
        $this->trainerPokemonRepository = $trainerPokemonRepository;
    }

    public function create($payload)
    {
        return $this->trainerPokemonRepository->create($payload);
    }

    public function drop($payload)
    {
        return $this->trainerPokemonRepository->dropPokemon(@$payload);
    }

    public function deleteTrainer($idTrainer)
    {
        return $this->trainerPokemonRepository->deleteTrainer($idTrainer);
    }
}
