<?php

namespace App\Repositories;

use App\Models\Pokemon;

use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Routing\Exception\InvalidArgumentException;
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

    public function create(string $pokemonName)
    {
        $pokemonName = strtolower($pokemonName);

        if( $this->existByName($pokemonName) )
            return true;

        $pokemon = $this->getDataPokemon($pokemonName);

        if(!$pokemon)
            throw new InvalidArgumentException('Pokemon not exist!',404);

        $payload =[
            'name' => $pokemonName,
            'image_url' => $pokemon->sprites->front_default,
            'attribute' => $pokemon->types[0]->type->name
        ];

        $this->model->create($payload);
        return true;
    }

    public function getDataPokemon($name)
    {
        $urlPokeApi = 'https://pokeapi.co/api/v2/pokemon/';

        $url = $urlPokeApi . $name;

        try
        {
            $response = json_decode(file_get_contents($url));
        }catch (\ErrorException)
        {
            return false;
        }

        return $response;
    }

    public function existByName($name): bool
    {
        if($this->getByName($name))
            return true;

        return false;
    }

    public function getByName($name)
    {
        $pokemon = $this->model->where('name', $name)
                ->get()
                ->first();

        if($pokemon)
            return $pokemon;

        return false;
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
