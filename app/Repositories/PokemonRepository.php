<?php

namespace App\Repositories;

use App\Models\Pokemon;
use function view;

class PokemonRepository
{
    public function getAll()
    {
        return Pokemon::all($columns = [
            'id',
            'name',
            'image_url',
            'attribute'
        ]);
    }

    public function create(string $name)
    {
        $pokemon = $this->getDataPokemon($name);

        $payload =[
            'name' => $name,
            'image_url' => $pokemon->sprites->front_default,
            'attribute' => $pokemon->types[0]->type->name
        ];

        Pokemon::create($payload);

        return true;
    }

    public function getByName($name)
    {
        return Pokemon::where('name', $name)->get();
    }

    public function getDataPokemon($name)
    {
        $urlPokeApi = 'https://pokeapi.co/api/v2/pokemon/';

        $url = $urlPokeApi . $name;

        return json_decode(file_get_contents($url));
    }
}
