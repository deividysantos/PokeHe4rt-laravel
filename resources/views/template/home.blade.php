<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('style')
    <link rel="stylesheet" href="{{ asset('css/site.home.css') }}">
    <title>PokeHe4rt - @yield('title')</title>
</head>
<body>
<header>
    <a class="homeBtn" href="{{ route('site.home') }}">PokeHe4rt</a>
    @yield('header')
</header>
    <div class="container">
        @yield('content')
    </div>

    <footer>
        Desenvolvido por Deividy Santos
    </footer>

</body>
@yield('script')
</html>
