@extends('template.home')

@section('title', 'Create')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/app/trainer/createTrainer.css') }}">
@endsection

@section('content')

    <form class="form" action="{{  route('trainer.apiCreate') }}" method="POST">
        @csrf
        <p class="title">Sign up, new trainer</p>
        <div class="inputs">

            <input required type="text" id="name" name="name" placeholder="Name">

            <select required name="region">
                <option value="" selected disabled hidden>Region</option>
                <option value="Kanto">Kanto</option>
                <option value="Johto">Johto</option>
                <option value="Hoenn">Hoenn</option>
                <option value="Sinnoh">Sinnoh</option>
                <option value="Unova">Unova</option>
                <option value="Kalos">Kalos</option>
            </select>


            <input required type="number" id="age" name="age" placeholder="Age">
        </div>

        <input type="submit" value="Sign In">
    </form>
@endsection
