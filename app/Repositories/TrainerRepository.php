<?php

namespace App\Repositories;

use App\Models\Trainer;

class TrainerRepository
{
    protected Trainer $model;

    public function __construct(Trainer $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getByName($trainerName)
    {
        return $this->model->where('name', $trainerName)->get();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getByRegionAndName($region, $name)
    {
        return $this->model->where('region', $region)->where( 'name', $name)->get();
    }

    public function create($payload)
    {
        $equalsTrainer = $this->getByName($payload['name']);

        foreach ($equalsTrainer as $equalTrainer)
        {
            if($equalTrainer->region == $payload['region'])
                return false;
        }

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
