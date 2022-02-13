<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Trainer extends Authenticatable
{
    use HasFactory;

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
        'password',
        'remember_token',
    ];

    public function trainerPokemon()
    {
        return $this->hasMany(TrainerPokemon::class);
    }
}
