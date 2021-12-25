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

    public function getDataPokemon($name)
    {
        return $this->pokemonRepository->getDataPokemon($name);
    }

    public function ucwordsMethod($collection, $atribute)
    {
        return $collection->map(function($item, $key) use ($atribute) {
            $item[$atribute] = ucwords($item[$atribute]);
            return $item;
        });
    }

    public function getTypes()
    {
            return $types = [
            'bug' => '#089933',
            'dark' => '#3b3736',
            'dragon' => '#6b98ca',
            'electric' => '#d6da00',
            'fairy' => '#da2a5d',
            'fighting' => '#b85d21',
            'fire' => '#de3d24',
            'flying' => '#5f8cce',
            'ghost' => '#6f00b7',
            'grass' => '#03c900',
            'ground' => '#a85729',
            'ice' => '#22cbda',
            'normal' => '#997597',
            'poison' => '#3f046e',
            'psychic' => '#d9107a',
            'rock' => '#582300',
            'steel' => '#007e66',
            'water' => '#2e36e1'
        ];
    }
}
