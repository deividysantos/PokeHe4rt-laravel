<?php

namespace App\Repositories;

use App\Models\Pokemon;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
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

        $payload =[
            'name' => $pokemonName,
            'image_url' => $pokemon['sprites']['front_default'],
            'attribute' => $pokemon['types'][0]['type']['name']
        ];

        $this->model->create($payload);
        return true;
    }

    public function getDataPokemon(string $name)
    {
        $urlPokeApi = 'https://pokeapi.co/api/v2/pokemon/';

        $url = $urlPokeApi . $name;

        $response = Http::get($url);

        if($response->ok())
            return $response->json();

        return false;
    }

    public function existByName(string $name): bool
    {
        if($this->getByName($name))
            return true;

        return false;
    }

    public function getByName(string $name)
    {
        $pokemon = $this->model->where('name', $name)
                ->get()
                ->first();

        if($pokemon)
            return $pokemon;

        return false;
    }

    public function formatDataToShowPokemon(string $namePokemon)
    {
        $dataPokemon = $this->getDataPokemon($namePokemon);

        return [
            'name' => $dataPokemon['name'],
            'image_url' => $dataPokemon['sprites']['front_default'],
            'height' => $dataPokemon['height'],
            'weight' => $dataPokemon['weight'],
            'abilities' => $this->getAbilities($dataPokemon['abilities']),
            'stats' => $this->getStats($dataPokemon['stats']),
            'types' => $this->getTypes($dataPokemon['types'])
        ];
    }

    private function getAbilities(mixed $abilities)
    {
        $payload = [];
        foreach ($abilities as $ability)
        {
            $payload[] = $ability['ability']['name'];
        }

        return $payload;
    }

    private function getStats(mixed $stats)
    {
        $payload = [];
        foreach ($stats as $stat)
        {
            $payload[$stat['stat']['name']] = $stat['base_stat'];
        }

        return $payload;
    }

    private function getTypes(mixed $types)
    {
        $payload = [];
        foreach ($types as $type)
        {
            $payload[] = $type['type']['name'];
        }
        return $payload;
    }
}
