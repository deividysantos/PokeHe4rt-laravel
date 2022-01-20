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

    public function create($payload)
    {
        return $this->model->create($payload);
    }
}
