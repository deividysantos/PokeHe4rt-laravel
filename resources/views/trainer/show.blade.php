@extends('site.home')

@section('title',$trainer->name)

@section('content')
    <p>{{ $trainer->name }} <a href="{{ route('pokemon.index', $trainer->id) }}">Add Pokemon</a></p>
    Region:{{ $trainer->region }} | Age: {{ $trainer->age }}

    <hr>

    @foreach ($pokemons ?? [] as $pokemon)
    {{ $pokemon->name }}
    <img src="{{ $pokemon->image_url }}" alt="image of {{ $pokemon->name }}">
    <br><br>
    @endforeach
@endsection
