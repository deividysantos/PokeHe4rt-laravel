<?php

namespace App\Repositories\Contracts;

interface IPokemonRepository
{
    function getAll();
    function create(array $payload);
    function existByName(string $pokemonName);
    function getByName(string $pokemonName);
}
