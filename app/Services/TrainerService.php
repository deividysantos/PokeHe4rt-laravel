<?php

namespace App\Services;

use App\Repositories\TrainerRepository;

class TrainerService
{
    private TrainerRepository $trainerRepository;

    public function __construct(TrainerRepository $trainerRepository)
    {
        $this->trainerRepository = $trainerRepository;
    }

    public function getAll()
    {
        return $this->trainerRepository->getAll();
    }

    public function getById($id)
    {
        return $this->trainerRepository->getById($id);
    }

    public function create($payload)
    {
        return $this->trainerRepository->create($payload);
    }

    public function getPokemons($idTrainer)
    {
        return $this->trainerRepository->getPokemons($idTrainer);
    }
}
