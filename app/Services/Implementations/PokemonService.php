<?php

namespace App\Services\Implementations;

use App\Exceptions\PokemonNameNotExist;
use App\Repositories\Contracts\IPokemonRepository;
use App\Services\Contract\IPokemonService;
use Illuminate\Support\Facades\Http;

class PokemonService implements IPokemonService
{
    public function __construct(
        private IPokemonRepository $pokemonRepository,
    )
    {
    }

    public function getDataPokemon(string $namePokemon): mixed
    {
        $urlPokeApi = 'https://pokeapi.co/api/v2/pokemon/';

        $url = $urlPokeApi . strtolower($namePokemon);

        $response = Http::get($url);

        if($response->ok())
            return $response->json();

        if($response->status() == 404)
            throw new PokemonNameNotExist('The pokemon "'. $namePokemon . '" not exist!');

        return false;
    }

    public function formatDataToShowPokemon(string $pokemonName):array
    {
        $dataPokemon = $this->getDataPokemon($pokemonName);

        $getAbilities = fn($ability) => $ability['ability']['name'];
        $getType = fn($type) => $type['type']['name'];

        return [
            'name' => $dataPokemon['name'],
            'image_url' => $dataPokemon['sprites']['front_default'],
            'height' => $dataPokemon['height'],
            'weight' => $dataPokemon['weight'],
            'abilities' => array_map($getAbilities ,$dataPokemon['abilities']),
            'stats' => $this->getStatus($dataPokemon['stats']),
            'types' => array_map($getType, $dataPokemon['types'])
        ];
    }

    public function create(string $pokemonName): bool
    {
        $pokemonName = strtolower($pokemonName);

        if( $this->pokemonRepository->existByName($pokemonName) )
            return true;

        $pokemon = $this->getDataPokemon($pokemonName);

        $payload =[
            'name' => $pokemonName,
            'image_url' => $pokemon['sprites']['front_default'],
            'attribute' => $pokemon['types'][0]['type']['name']
        ];

        $this->pokemonRepository->create($payload);
        return true;
    }

    private function getStatus(array $stats)
    {
        $payload = [];

        foreach ($stats as $stat)
        {
            if(explode('-', $stat['stat']['name'])[0] === 'special')
                continue;

            $payload[ $stat['stat']['name'] ] = $stat['base_stat'];
        }

        return $payload;
    }
}
