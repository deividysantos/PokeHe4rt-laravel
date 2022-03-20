<?php

namespace App\Policies;

use App\Models\Trainer;
use Illuminate\Auth\Access\HandlesAuthorization;

class PokemonTrainerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function pokemonsBelongsToTrainer(Trainer $trainer ,$trainerPokemon): bool
    {
        return $trainer->id == $trainerPokemon->trainer_id;
    }
}
