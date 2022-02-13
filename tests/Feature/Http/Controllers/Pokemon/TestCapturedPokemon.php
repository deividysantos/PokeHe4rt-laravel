<?php

namespace Tests\Feature\Http\Controllers\Pokemon;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Trainer;
use Tests\TestCase;

class TestCapturedPokemon extends TestCase
{
    use DatabaseMigrations;

    public function testShouldBeCapturedWhenPokemonNameIsValid()
    {
        $pokemonNameValid = 'ditto';
        $trainer = Trainer::Factory()->create();

        $this->actingAs($trainer);
        $response = $this->post(route('capturePokemon', $pokemonNameValid));

        var_dump($response);
    }
}
