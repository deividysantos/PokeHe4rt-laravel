@extends('site.home')

@section('title', $pokemon['name'] )

@section('style')
    <link rel="stylesheet" href="{{ asset('css/pokemon/pokemonShow.css') }}">
@endsection

@section('content')
    <div class="pokemon">
        <p class="pokemonName">{{$pokemon['name']}}</p>
        <div class="pokemonInfos">

            <img class="imgPokemon" src="{{$pokemon['image_url']}}" alt="image of {{$pokemon['name']}}">

            @if($pokemon['countTypes'] === 1)
                <p>Type: {{ $pokemon['type'][0] }}</p>
            @endif

            @if($pokemon['countTypes'] > 1)
                <p> Types: |
                @foreach($pokemon['type'] as $type)
                    {{$type}} |
                @endforeach
                </p>
            @endif

            <p>Weight: {{$pokemon['weight']}} <br>Height: {{$pokemon['height']}} </p>
        </div>
        <hr>
        <a class="backToProfile" href="{{route('trainer.show', $idTrainer)}}">
          < Back to User Profile
        </a>
    </div>
@endsection
