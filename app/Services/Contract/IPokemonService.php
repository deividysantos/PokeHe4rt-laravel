<?php

namespace App\Services\Contract;

interface IPokemonService
{
    function getDataPokemon(string $namePokemon):mixed;
    function formatDataToShowPokemon(string $namePokemon):array;
    function createIfPokemonNotExist(string $namePokemon):bool;
}
