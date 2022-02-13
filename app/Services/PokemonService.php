<?php

namespace App\Services;

use App\Repositories\PokemonRepository;
use Illuminate\Support\Facades\Http;

class PokemonService
{
    public function getDataPokemon(string $namePokemon)
    {
        $urlPokeApi = 'https://pokeapi.co/api/v2/pokemon/';

        $url = $urlPokeApi . $namePokemon;

        $response = Http::get($url);

        if($response->ok())
            return $response->json();

        return false;
    }
}
