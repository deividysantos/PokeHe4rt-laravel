<?php

namespace App\Services\Contract;

interface IPokemonService
{
    function getDataPokemonByName(string $namePokemon):mixed;
    function createBabyPokemon(int $id):mixed;
    function formatDataToShowPokemon(string $namePokemon):array;
    function createByName(string $namePokemon):bool;
}
