<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonTrainer extends Model
{
    protected $table = 'pokemon_trainer';

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
