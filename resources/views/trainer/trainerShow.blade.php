@extends('site.home')

@section('title', $trainer->name)

@section('style')
    <link rel="stylesheet" href="{{ asset('css/pokemon/pokemonList.css') }}">
    <link rel="stylesheet" href="{{ asset('css/trainer/profile.css') }}">
@endsection

@section('content')
    <p class="trainerName"> {{ $trainer->name }}</p>
    <div class="content">
        <div class="infosTrainer">

            <p>Region: {{ $trainer->region }}</p>
            <p>Age: {{ $trainer->age }}</p>
        </div>
        <a class="captureBtn" href="{{ route('pokemon.index', $trainer->id) }}">Capture a Pokemon</a>

        <div class="pokemonsCaptured">
        @foreach ($pokemons ?? [] as $pokemon)

                <div class="pokemonCaptured">
                    <a href="{{ route('pokemon.show', [$trainer->id, $pokemon->name]) }}">
                        <img src="{{ $pokemon->image_url }}" alt="image of {{ $pokemon->name }}">
                    </a>
                    <p>{{ $pokemon->name }}</p>
                    <form action="{{route('trainer.drop')}}" method="POST">
                        @csrf
                        <input type="hidden" name="pokemon_id" value="{{ $pokemon->id }}">
                        <input type="hidden" name="trainer_id" value="{{ $trainer->id }}">
                        <input class="submitBtn" type="submit" value="drop">
                    </form>
                </div>
                @endforeach
        </div>
        <hr>
        <a class="backToTrainerList" href="{{route('trainer.index')}}">< Back to trainers list</a>
    </div>
@endsection
