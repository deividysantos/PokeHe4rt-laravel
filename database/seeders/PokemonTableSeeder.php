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
        for($i = 366; $i <= 476; $i++)
        {
            echo $i . ' ';

            if(!$this->pokemonService->createBabyPokemon($i))
            {
                sleep(2);
                $i = $i - 1;
            }
        }
    }
}
