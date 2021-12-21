@extends('site.home')

@section('title', 'Trainers')

@section('style')
    <link  rel="stylesheet" href="{{ asset('css/trainerList.css') }}">
@endsection

@section('content')

@foreach($trainers as $trainer)
        <div class="trainers">
           {{ $trainer->name }} of {{ $trainer->region }}
            <a href="{{ route('trainer.show', $trainer->id) }}">Show More</a>
        </div>
    @endforeach
<hr>
<a class="newTrainerBtn" href="{{ route('trainer.create') }}">Create a new trainer</a>
@endsection
