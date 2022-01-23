<?php

namespace App\Repositories;

interface IPokemonRepository extends IRepository
{
    function existByName(string $pokemonName);
    function getByName(string $pokemonName);
    function createIfPokemonNotExist(string $pokemonName);
}
