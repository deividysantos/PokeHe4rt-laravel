@extends('template.home')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/app/components/signUpBtn.css')}}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css')}}">
@endsection

@section('header')

    <div>
        <a href="{{route('login')}}" class="cadastroBtn">
            <p>Login</p>
        </a>

        <a href="{{route('register')}}" class="cadastroBtn">
            <p>
                Sign Up
            </p>
        </a>
    </div>

@endsection

@section('content')
    <section class="welcome">
            <p class="informacao">
                Seja Bem Vindo Treinador
            </p>
    </section>

    <section class="lives">

    </section>
@endsection

@section('script')

@endsection
