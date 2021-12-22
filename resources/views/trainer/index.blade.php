@extends('site.home')

@section('title', 'Trainers')

@section('style')
    <link  rel="stylesheet" href="{{ asset('css/trainer/trainerList.css') }}">
@endsection

@section('content')

@foreach($trainers as $trainer)
        <div class="trainers">
           <p>{{ $trainer->name }}</p>

            <div class="options">
                <a href="{{ route('trainer.show', $trainer->id) }}"><span>Show More</span></a>
                <form>
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="{{ $trainer->id }}">
                    <input type="submit" value="Delete">
                </form>
            </div>

        </div>
    @endforeach
<hr>

<div class="newTrainerBtn">
    <a href="{{ route('trainer.create') }}">Create a new trainer</a>
</div>
@endsection
