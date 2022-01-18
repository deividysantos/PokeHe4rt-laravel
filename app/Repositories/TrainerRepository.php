<?php

namespace App\Repositories;

use App\Exceptions\TrainerAlreadyExisits;
use App\Models\Trainer;

class TrainerRepository
{
    protected Trainer $model;

    public function __construct(Trainer $model)
    {
        $this->model = $model;
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create($payload)
    {
        return $this->model->create($payload);
    }

    public function getPokemons($idTrainer)
    {
        $trainer = $this->getById($idTrainer);

        return $trainer->pokemons;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
