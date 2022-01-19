<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <title>PokeHe4rt - @yield('title')</title>
    </head>
<body>
    <header class="flex flex-row flex-wrap justify-between bg-white shadow">
        <div class="p-5">
            <a class="shadow px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-900" href="{{ route('site.home') }}">
                PokeHe4rt
            </a>
        </div>

        <div class="flex flex-row p-5">
            @if(!Auth::user())

                <a href="{{route('login')}}" class="border-b-2 border-transparent hover:border-indigo-600">
                    Login
                </a>

                <a href="{{route('register')}}" class="ml-3 border-b-2 border-transparent hover:border-indigo-600">
                    Sign Up
                </a>

            @else

                <a href="{{route('myPokemonsView')}}" class="border-b-2 border-transparent hover:border-indigo-600">
                    My Pokemons
                </a>

                <form class="ml-5 border-b-2 border-transparent hover:border-indigo-600" action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="" onclick="submit()">Logout</button>
                </form>

            @endif
        </div>
    </header>

</body>
</html>
