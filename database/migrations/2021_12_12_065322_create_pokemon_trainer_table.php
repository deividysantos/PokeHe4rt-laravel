<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonTrainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemon_trainer', function (Blueprint $table) {
            $table->id();
            $table->string('nickName')->nullable();
            $table->foreignId('trainer_id')->references('id')->on('trainers');
            $table->foreignId('pokemon_id')->references('id')->on('pokemons');
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
        Schema::dropIfExists('pokemon_trainer');
    }
}
