@extends('site.home')

@section('title', 'Create')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')

    <form class="form" action="{{  route('trainer.store') }}" method="POST">
        @csrf
        <p class="title">Sign in a new trainer</p>
        <div class="inputs">
            <label for="name">Name</label>
            <input type="text" id="name" name="name">


            <label for="region">Region</label>
            <input type="text" id="region" name="region">

            <label for="age">Age</label>
            <input type="number" id="age" name="age">
        </div>

        <input type="submit" value="Sign In">
    </form>
@endsection
