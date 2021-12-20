@extends('site.home')

@section('title', 'Pokemons')

@section('content')
    @foreach ($pokemons ?? [] as $pokemon)
    {{ $pokemon->name }}
    <img src="{{ $pokemon->image_url }}" alt="image of {{ $pokemon->name }}">
    <br><br>
    @endforeach
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