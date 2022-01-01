@extends('site.home')

@section('style')
        <link rel="stylesheet" href="{{ asset('css/homepage.css')}} ">
@endsection

@section('header')
    <a href="https://www.twitch.tv/" class="loginTwitch">
        <img src="{{ asset('images/twitch.png') }}" alt="twitch">
        <p>
            Login
        </p>
    </a>
@endsection

@section('content')
    <section class="welcome">
        <div class="test">
            <p class="informacao">
                Acompanhe streamers parceiros e aumente <br>sua coleção de -> pokemons <-
            </p>
        </div>
    </section>

    <section class="lives">

    </section>
@endsection

@section('script')

@endsection
