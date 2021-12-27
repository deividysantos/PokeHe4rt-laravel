<?php

namespace App\Repositories;

use App\Models\Pokemon;
use function view;

class PokemonRepository
{
    protected Pokemon $model;

    public function __construct(Pokemon $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create(string $name)
    {
        $pokemon = $this->getDataPokemon($name);

        $payload =[
            'name' => $name,
            'image_url' => $pokemon->sprites->front_default,
            'attribute' => $pokemon->types[0]->type->name
        ];

        $this->model->create($payload);

        return true;
    }

    public function getByName($name)
    {
        return $this->model->where('name', $name)->get();
    }

    public function getDataPokemon($name)
    {
        $urlPokeApi = 'https://pokeapi.co/api/v2/pokemon/';

        $url = $urlPokeApi . $name;

        return json_decode(file_get_contents($url));
    }

    public function existByName($name)
    {
        if(isset($this->getByName($name)[0]))
            return true;

        return false;
    }

    public function ucfirstMethod($collection, $atribute)
    {
        return $collection->map(function($item) use ($atribute) {
            return ucfirst($item[$atribute]);
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
