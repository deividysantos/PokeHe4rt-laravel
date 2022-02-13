<?php

namespace App\Repositories;

use App\Models\Pokemon;

use App\Services\PokemonService;

class PokemonRepository implements IPokemonRepository
{
    private Pokemon $model;
    private PokemonService $pokemonService;

    public function __construct(Pokemon $model,
                                PokemonService $pokemonService)
    {
        $this->model = $model;
        $this->pokemonService = $pokemonService;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create(array $pokemonData)
    {
        return $this->model->create($pokemonData);
    }

    public function createIfPokemonNotExist(string $pokemonName): bool
    {
        $pokemonName = strtolower($pokemonName);

        if( $this->existByName($pokemonName) )
            return true;

        $pokemon = $this->pokemonService->getDataPokemon($pokemonName);

        $payload =[
            'name' => $pokemonName,
            'image_url' => $pokemon['sprites']['front_default'],
            'attribute' => $pokemon['types'][0]['type']['name']
        ];

        gettype($this->create($payload));
        return true;
    }

    public function existByName(string $pokemonName): bool
    {
        if($this->getByName($pokemonName))
            return true;

        return false;
    }

    public function getByName(string $pokemonName)
    {
        return $this->model->where('name', $pokemonName)
                ->get()
                ->first();
    }

    public function formatDataToShowPokemon(string $pokemonName):array
    {
        $dataPokemon = $this->pokemonService->getDataPokemon($pokemonName);

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

    private function getAbilities(array $abilities)
    {
        $payload = [];
        foreach ($abilities as $ability)
        {
            $payload[] = $ability['ability']['name'];
        }

        return $payload;
    }

    private function getStats(array $stats)
    {
        $payload = [];
        foreach ($stats as $stat)
        {
            $payload[$stat['stat']['name']] = $stat['base_stat'];
        }

        return $payload;
    }

    private function getTypes(array $types)
    {
        $payload = [];
        foreach ($types as $type)
        {
            $payload[] = $type['type']['name'];
        }
        return $payload;
    }
}
