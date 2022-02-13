<?php

namespace App\Repositories;

use App\Models\TrainerPokemon;
use Illuminate\Support\Facades\DB;

class TrainerPokemonRepository implements ITrainerPokemonRepository
{
    protected TrainerPokemon $model;

    public function __construct(TrainerPokemon $model)
    {
        $this->model = $model;
    }

    public function create(array $trainerPokemonData):bool
    {
        echo gettype($this->model->create($trainerPokemonData));
        return true;
    }

    public function dropPokemon(int $trainerPokemonId):bool
    {
        $trainerPokemon = $this->model->find($trainerPokemonId);

        if($trainerPokemon)
            return $trainerPokemon->delete();

        return false;
    }

    public function getById(string $trainerPokemonId)
    {
        return $this->model->find($trainerPokemonId);
    }

    public function editNicknamePokemon(string $trainerPokemonId, string $nicknamePokemon)
    {
        $trainerPokemon = $this->model->find($trainerPokemonId);

        if(!$trainerPokemon)
            return false;

        $trainerPokemon->nickName = $nicknamePokemon;

        return $trainerPokemon->save();
    }
}
