<?php

namespace App\Repositories\Contracts;

interface ITrainerPokemonRepository
{
    function create(array $payload):bool;
    function dropPokemon(int $trainerPokemonId):bool;
    function getById(string $trainerPokemonId);
    function editNicknamePokemon(string $trainerPokemonId, string $nickname);
}
