<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerPokemonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_pokemon', function (Blueprint $table) {
            $table->unsignedBigInteger('trainer_id');
            $table->unsignedBigInteger('pokemon_id');

            $table->foreign('trainer_id')->references('id')->on('trainers');
            $table->foreign('pokemon_id')->references('id')->on('pokemons');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainer_pokemon');
    }
}
