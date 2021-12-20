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
        $urlPokeApi = 'https://pokeapi.co/api/v2/pokemon/';

        $url = $urlPokeApi . $name;

        try {

            $response = json_decode(file_get_contents($url));

        } catch (\Throwable $th) {
            return view('trainer.index');//pagina de erro
        }

        $payload =[
            'name' => $name,
            'image_url' => $response->sprites->front_default,
            'attribute' => $response->types[0]->type->name
        ];

        Pokemon::create($payload);

        return true;
    }

    public function getByName($name)
    {
        return Pokemon::where('name', $name)->get();
    }
}
