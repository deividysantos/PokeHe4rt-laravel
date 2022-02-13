<?php

namespace App\Repositories;

interface IPokemonRepository
{
    function getAll();
    function create(array $payload);
    function existByName(string $pokemonName);
    function getByName(string $pokemonName);
    function createIfPokemonNotExist(string $pokemonName);
}
