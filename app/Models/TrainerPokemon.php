<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerPokemon extends Model
{
    protected $table = 'trainer_pokemon';

    protected $fillable = [
        'trainer_id',
        'pokemon_id'
    ];
}
