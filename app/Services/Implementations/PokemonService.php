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

    function getData(string $url)
    {
        $response = Http::get($url);

        if($response->ok())
            return $response->json();

        return false;
    }

    public function getDataPokemonByName(string $pokemonName): mixed
    {
        $urlPokeApi = 'https://pokeapi.co/api/v2/pokemon/';

        $url = $urlPokeApi . strtolower($pokemonName);

        $response = $this->getData($url);

        if(!$response)
            throw new PokemonNameNotExist('The pokemon "'. $pokemonName . '" not exist!');

        return $response;
    }

    function createBabyPokemon(int $id): mixed
    {
        $urlPokeApi = 'https://pokeapi.co/api/v2/evolution-chain/' . $id;

        $data = $this->getData($urlPokeApi);

        if(empty($data['chain']['evolves_to']))
            return true;

        try {
            $this->createByName($data['chain']['species']['name']);
        }
        catch (\Exception $e){
            return false;
        }

        return true;
    }

    public function formatDataToShowPokemon(string $pokemonName):array
    {
        $dataPokemon = $this->getDataPokemonByName($pokemonName);

        $getAbilities = fn($ability) => $ability['ability']['name'];
        $getType = fn($type) => $type['type']['name'];

        return [
            'name' => $dataPokemon['name'],
            'image_url' => $dataPokemon['sprites']['other']['official-artwork']['front_default'],
            'height' => $dataPokemon['height'],
            'weight' => $dataPokemon['weight'],
            'abilities' => array_map($getAbilities ,$dataPokemon['abilities']),
            'stats' => $this->getStatus($dataPokemon['stats']),
            'types' => array_map($getType, $dataPokemon['types'])
        ];
    }

    public function createByName(string $pokemonName): bool
    {
        $pokemonName = strtolower($pokemonName);

        if( $this->pokemonRepository->existByName($pokemonName) )
            return true;

        $pokemon = $this->getDataPokemonByName($pokemonName);

        $payload =[
            'name' => $pokemon['name'],
            'image_url' => $pokemon['sprites']['other']['official-artwork']['front_default'],
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
