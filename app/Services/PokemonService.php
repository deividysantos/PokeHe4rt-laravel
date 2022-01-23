<?php

namespace App\Services;

use App\Repositories\PokemonRepository;
use Illuminate\Support\Facades\Http;

class PokemonService
{
    public function getDataPokemon(string $name)
    {
        $urlPokeApi = 'https://pokeapi.co/api/v2/pokemon/';

        $url = $urlPokeApi . $name;

        $response = Http::get($url);

        if($response->ok())
            return $response->json();

        return false;
    }
}
