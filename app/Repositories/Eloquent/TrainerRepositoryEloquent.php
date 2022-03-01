<?php

namespace App\Repositories\Eloquent;

use App\Models\Trainer;
use App\Repositories\Contracts\ITrainerRepository;

class TrainerRepositoryEloquent implements ITrainerRepository
{
    public function __construct(
        private Trainer $model
    )
    {
    }

    public function create(array $trainerData)
    {
        return $this->model->create($trainerData);
    }
}
