@extends('site.home')

@section('title', $trainer->name)

@section('style')
    <link rel="stylesheet" href="{{ asset('css/pokemon/pokemonList.css') }}">
@endsection

@section('content')
    <div>
        <p>Trainer: {{ $trainer->name }}</p>
        <p>Region: {{ $trainer->region }}</p>
        <p>Age: {{ $trainer->age }}</p>
    </div>
    <a href="{{ route('pokemon.index', $trainer->id) }}">Add Pokemon</a>
    <hr>
<div class="pokemonsCaptured">
    @foreach ($pokemons ?? [] as $pokemon)

        <div class="pokemonCaptured">
            <img src="{{ $pokemon->image_url }}" alt="image of {{ $pokemon->name }}">
            <p>{{ $pokemon->name }}</p>
            <form action="{{route('trainer.drop')}}" method="POST">
                @csrf
                <input type="hidden" name="pokemon_id" value="{{ $pokemon->id }}">
                <input type="hidden" name="trainer_id" value="{{ $trainer->id }}">
                <input type="submit" value="drop">
            </form>

        </div>
    @endforeach
</div>
    <hr>
    <a href="{{route('trainer.index')}}">Back to trainers list</a>
@endsection
