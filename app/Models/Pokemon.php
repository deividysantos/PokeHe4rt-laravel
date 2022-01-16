<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table ='pokemons';

    protected $fillable = [
        'id',
        'name',
        'image_url',
        'attribute'
    ];

    public function trainerPokemon()
    {
        return $this->hasMany(TrainerPokemon::class);
    }
}
