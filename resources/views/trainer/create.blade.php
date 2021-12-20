@extends('site.home')

@section('title', 'Create')

@section('content')
    <form action="{{  route('trainer.store') }}" method="POST">
        @csrf
        name
        <input type="text" name="name">

        region
        <input type="text" name="region">

        age
        <input type="number" name="age">

        <input type="submit" value="submit">
    </form>
@endsection