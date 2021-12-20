@extends('site.home')

@section('title','New Pokemon')

@section('content')
<form action="{{ route('pokemon.store') }}" method="POST">
    @csrf
    <label for="namePokemon">Pokemon Name</label>
    <input type="text" name="namePokemon" id="namePokemon">

    <input type="submit" value="Submit">
</form>
@endsection

