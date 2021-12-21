@extends('site.home')

@section('title', 'Trainers')

@section('content')

<a href="{{ route('trainer.create') }}">Create a new trainer</a>

<br><br>

@foreach($trainers as $trainer)
        <div>
           {{ $trainer->name }} of {{ $trainer->region }}
            <a href="{{ route('trainer.show', $trainer->id) }}">Show More</a>
        </div>
        <br>
    @endforeach
@endsection
