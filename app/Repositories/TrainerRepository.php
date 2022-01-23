<?php

namespace App\Repositories;

use App\Models\Trainer;

class TrainerRepository implements ITrainerRepository
{
    protected Trainer $model;

    public function __construct(Trainer $model)
    {
        $this->model = $model;
    }

    public function create(array $payload)
    {
        return $this->model->create($payload);
    }
}
