<?php

namespace App\Repositories;

interface IRepository
{
    function getById(string $id);
    function getAll();
    function update();
    function create(array $payload);
    function delete(array $payload);
}
