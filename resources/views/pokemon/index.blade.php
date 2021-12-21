@extends('site.home')

@section('title', 'Pokemons')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/pokemonList.css') }}">
@endsection

@section('content')

    <div class="pokemonsCaptured">
        @foreach ($pokemons ?? [] as $pokemon)
            <div class="pokemonCaptured">
                <img src="{{ $pokemon->image_url }}" alt="image of {{ $pokemon->name }}">
                <p>{{ $pokemon->name }}</p>
            </div>
        @endforeach
    </div>
<hr>

    <a href="{{ route('pokemon.create') }}">Create a new Pokemon</a>

    <form action="{{ route('trainer.capture') }}" method="POST">
        @csrf
        Capture Pokemon
        <input type="hidden" name="idTrainer" value="{{ $idTrainer }}">
        <input type="text" name="namePokemon" placeholder="name">

    <input type="submit" value="Submit">
    </form>
@endsection
