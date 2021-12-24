@extends('site.home')

@section('title', 'Trainers')

@section('style')
    <link  rel="stylesheet" href="{{ asset('css/trainer/trainerList.css') }}">
@endsection

@section('header')
    <div class="newTrainerBtn">
        <a href="{{ route('trainer.create') }}">Create a new trainer</a>
    </div>
@endsection

@section('content')
@foreach($trainers as $trainer)
        <div class="trainers">
            <div class="nameTrainer">
                <p>{{ $trainer->name }}</p>
            </div>
            <div class="infos">
                <div class="regionTrainer">
                    <p>{{ $trainer->region }}</p>
                </div>
                <div class="options">
                    <a href="{{ route('trainer.show', $trainer->id) }}"><span>Show More</span></a>
                    <form action="{{route('trainer.destroy', $trainer->id)}}" method="GET">
                        <input type="submit" value="Delete">
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
