<?php

namespace Tests\Feature\Http\Controllers\Pokemon;

use App\Models\Pokemon;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CapturedPokemonTest extends TestCase
{
    public function test_should_be_able_capture_a_pokemon()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $namePokemon = 'ditto';

        //$this->post(Route('capturePokemon'))
    }
}
