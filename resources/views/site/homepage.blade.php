@extends('template.home')

@section('style')
        <link rel="stylesheet" href="{{ asset('css/homepage.css')}} ">
@endsection

@section('header')
    @include('components.signUpBtn')
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
