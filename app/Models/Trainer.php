<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Trainer extends Authenticatable
{
    protected $table ='trainers';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'email',
        'name',
        'region',
        'age',
        'password',
    ];

    protected $hidden = [

        'remember_token',
    ];

    public function pokemons()
    {
        return $this->belongsToMany(Pokemon::class, 'trainer_pokemon');
    }
}
