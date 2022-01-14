<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('style')
    <link rel="stylesheet" href="{{ asset('css/errorPage.css') }}">
    <title>Error</title>
</head>
<body>

<div class="image">
    <p class="message">
        {{$messageError}}
    </p>
</div>


</body>
</html>
