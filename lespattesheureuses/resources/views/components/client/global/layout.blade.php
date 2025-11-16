<!doctype html>
<html lang="{!! App::getLocale() !!}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Les pattes heureuses') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins overflow-x-hidden">
<x-client.global.nav/>
<main class="w-[calc(100%-32px*2)] md:w-[calc(100%-48*2)] lg:w-[calc(100%-64px*2)] mx-auto">
    {{$slot}}
</main>
<x-client.global.footer/>
</body>
</html>
