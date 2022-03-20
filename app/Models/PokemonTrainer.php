<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerPokemon extends Model
{
    protected $table = 'trainer_pokemon';

    protected $fillable = [
        'id',
        'nickName',
        'trainer_id',
        'pokemon_id'
    ];

    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}

/*
 * trainer
 *      belongsToMany TrainerPokemon
 *
 * trainerPokemon
 *      belongsTo Trainer
 *      belongsTo Pokemon
 *
 * pokemon
 *      belongsToMany TrainerPokemon
 *
 * */
