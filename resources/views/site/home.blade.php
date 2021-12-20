<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/site.home.css') }}">
    <script src="{{ asset('js/swal.js') }}"></script>
    <script src="{{ asset('js/siteHome.js') }}"></script>
    <title>PokeHe4rt - @yield('title')</title>
</head>
<body>
<header>
    <a href="{{ route('trainer.index') }}">PokeHe4rt</a>
</header>
    <div>
        @yield('content')
    </div>
</body>
</html>
