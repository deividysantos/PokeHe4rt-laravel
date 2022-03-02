<?php

namespace Database\Seeders;

use App\Services\Contract\IPokemonService;
use Illuminate\Database\Seeder;

class PokemonTableSeeder extends Seeder
{
    public function __construct(
        private IPokemonService $pokemonService
    )
    {
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 200; $i++)
        {
            $this->pokemonService->create($i);
        }
    }
}
