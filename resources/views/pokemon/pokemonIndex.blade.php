@extends('site.home')

@section('title', 'Pokemons')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/pokemon/pokemonList.css') }}">
@endsection

@section('header')
    <form action="{{ route('trainer.capture') }}" method="POST">
        @csrf
        <input type="hidden" name="idTrainer" value="{{ $idTrainer }}">
        <input type="text" name="namePokemon" id="namePokemon" placeholder="Name">

        <input type="submit" value="Submit">
    </form>
@endsection

@section('content')

    <div class="pokemonsCaptured">
        @foreach ($pokemons ?? [] as $pokemon)
            <div class="pokemonCaptured" id="{{ $pokemon->id }}">
                <img style="cursor: pointer" onclick='autoFill("{{$pokemon->name}}", {{$pokemon->id}})' id="{{$pokemon->name}}" src="{{ $pokemon->image_url }}" alt="image of {{ $pokemon->name }}">
                <p>{{ $pokemon->name }}</p>
            </div>
        @endforeach
    </div>
<hr>
@endsection

@section('script')
<script src="{{ asset('js/script.js') }}"></script>
@endsection
