<?php

namespace App\Services;

use App\Repositories\PokemonRepository;

class PokemonService
{
    protected PokemonRepository $pokemonRepository;

    public function __construct(PokemonRepository $pokeRepository)
    {
        $this->pokemonRepository = $pokeRepository;
    }

    public function getAll()
    {
        return $this->pokemonRepository->getAll();
    }

    public function getByName($name)
    {
        return $this->pokemonRepository->getByName($name);
    }

    public function create(string $name)
    {
        if($this->existByName($name))
            return false;

        return $this->pokemonRepository->create($name);
    }

    public function existByName($name)
    {
        if(isset($this->pokemonRepository->getByName($name)[0]))
            return true;

        return false;
    }
}
