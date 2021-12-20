<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $table ='trainers';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'region',
        'age'
    ];

    public function pokemons()
    {
        return $this->belongsToMany(Pokemon::class, 'trainer_pokemon');
    }
}
