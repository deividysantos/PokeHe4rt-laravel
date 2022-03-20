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
    ];

    public function pokemonTrainer()
    {
        return $this->hasMany(PokemonTrainer::class);
    }
}
