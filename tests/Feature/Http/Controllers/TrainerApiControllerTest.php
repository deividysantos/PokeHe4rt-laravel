<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\TrainerController;
use App\Repositories\PokemonRepository;
use App\Repositories\TrainerPokemonRepository;
use App\Repositories\TrainerRepository;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class TrainerApiControllerTest extends testCase
{
private $trainerRepository;
private $pokemonRepository;
private $trainerPokemonRepository;
private $trainerController;

    public function createApplication()
    {
        return require './bootstrap/app.php';
    }

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->trainerRepository = $this->createMock(TrainerRepository::class);
        $this->pokemonRepository = $this->createMock(PokemonRepository::class);
        $this->trainerPokemonRepository = $this->createMock(TrainerPokemonRepository::class);

        $this->trainerController = new TrainerController($this->trainerRepository,
            $this->pokemonRepository,
            $this->trainerPokemonRepository
        );
    }

    /**
     *@test
     */
    public function shouldCreateNewTrainerWhenDataTrainerIsOk()
    {
        $payload = [
            'name' => 'Deividy',
            'region' => 'Kanto',
            'age' => 20
        ];

        $this->trainerRepository->expects($this->once())
            ->method('create');

        $response = $this->trainerController->store(new Request($payload));

        $shouldBeresponse = [
            'Create successfully'
        ];

        echo $response;

        //$this->assertEquals($shouldBeresponse, $response->);
        //$this->assertEquals(201, $response->status());
    }
}
