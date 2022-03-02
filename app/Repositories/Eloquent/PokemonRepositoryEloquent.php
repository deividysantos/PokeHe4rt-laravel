<?php

namespace App\Repositories\Eloquent;

use App\Models\Pokemon;
use App\Repositories\Contracts\IPokemonRepository;

class PokemonRepositoryEloquent implements IPokemonRepository
{
    public function __construct(
        private Pokemon $model
    )
    {
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create(array $pokemonData)
    {
        return $this->model->create($pokemonData);
    }

    public function existByName(string $pokemonName): bool
    {
        if($this->getByName($pokemonName))
            return true;

        return false;
    }

    public function getByName(string $pokemonName)
    {
        return $this->model
            ->where('name', $pokemonName)
            ->get()
            ->first();
    }

    public function getPaginate(int $paginate)
    {
        $paginate = $paginate == 1 ? 0 : ($paginate-1) * 18;

        return $this->model
            ->skip($paginate)
            ->take(18)
            ->orderBy('id')
            ->get();
    }
}
