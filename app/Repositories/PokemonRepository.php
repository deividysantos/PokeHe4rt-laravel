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

    public function create(array $payload)
    {
        return $this->model->create($payload);
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

        return$this->create($payload);
    }

    public function existByName(string $name): bool
    {
        if($this->getByName($name))
            return true;

        return false;
    }

    public function getByName(string $name): bool
    {
        $pokemon = $this->model->where('name', $name)
                ->get()
                ->first();

        if($pokemon)
            return $pokemon;

        return false;
    }

    function getById(string $id)
    {
        // TODO: Implement getById() method.
    }

    function update()
    {
        // TODO: Implement update() method.
    }

    function delete(array $payload)
    {
        // TODO: Implement delete() method.
    }

    public function formatDataToShowPokemon(string $namePokemon):array
    {
        $dataPokemon = $this->pokemonService->getDataPokemon($namePokemon);

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
