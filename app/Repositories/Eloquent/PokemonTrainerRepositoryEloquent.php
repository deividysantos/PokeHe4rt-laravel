<?php

namespace App\Repositories\Eloquent;

use App\Models\PokemonTrainer;
use App\Repositories\Contracts\IPokemonTrainerRepository;

class PokemonTrainerRepositoryEloquent implements IPokemonTrainerRepository
{
    public function __construct(
        private PokemonTrainer $model)
    {
    }

    public function create(array $pokemonTrainerData):bool
    {
        echo gettype($this->model->create($pokemonTrainerData));
        return true;
    }

    public function dropPokemon(int $pokemonTrainerId):bool
    {
        $pokemonTrainer = $this->model->find($pokemonTrainerId);

        if($pokemonTrainer)
            return $pokemonTrainer->delete();

        return false;
    }

    public function getById(string $pokemonTrainerId)
    {
        return $this->model->find($pokemonTrainerId);
    }

    public function editNicknamePokemon(string $pokemonTrainerId, string $nicknamePokemon)
    {
        $pokemonTrainer = $this->model->find($pokemonTrainerId);

        if(!$pokemonTrainer)
            return false;

        $pokemonTrainer->nickName = $nicknamePokemon;

        return $pokemonTrainer->save();
    }
}
