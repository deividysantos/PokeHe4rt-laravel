@extends('layouts.home')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/app/components/signUpBtn.css')}}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css')}}">
@endsection

@section('header')
@if(!Auth::user())
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
@else
    <div>
        <a href="{{route('dashboard')}}" class="cadastroBtn">
            <p>Dashboard</p>
        </a>

        <a href="{{route('logout')}}" class="cadastroBtn">
            <p>Logout</p>
        </a>
    </div>

@endif

@endsection

@section('content')
    <section class="welcome">
            <p class="informacao">
                Seja Bem Vindo Treinador
            </p>
    </section>
@endsection
