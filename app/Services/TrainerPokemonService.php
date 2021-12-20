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
}
