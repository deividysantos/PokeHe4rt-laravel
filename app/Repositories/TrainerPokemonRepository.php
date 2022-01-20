<?php

namespace App\Repositories;

use App\Models\TrainerPokemon;
use Illuminate\Support\Facades\DB;

class TrainerPokemonRepository
{
    protected TrainerPokemon $model;

    public function __construct(TrainerPokemon $model)
    {
        $this->model = $model;
    }

    public function create($payload)
    {
        return $this->model->create($payload);
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

    public function getPokemonByTrainerPokemon(string $trainerPokemonId)
    {
        return $this->model->find($trainerPokemonId)->pokemon;
    }

    public function editNicknamePokemon(string $trainerPokemonId, string $nickname)
    {
        $trainerPokemon = $this->model->find($trainerPokemonId);

        $trainerPokemon->nickName = $nickname;

        $trainerPokemon->save();
    }
}
