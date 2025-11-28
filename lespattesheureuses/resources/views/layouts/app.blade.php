<!doctype html>
<html lang="{!! App::getLocale() !!}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? '' }} - {{ config('app.name', 'Les pattes heureuses') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireScripts
</head>
<body class="overflow-x-hidden max-w-[1400px] mx-auto font-poppins flex gap-4">
<h1 class="sr-only">{{__('global.admin')}}</h1>
<livewire:admin.global.nav/>
<div class="mr-4 w-full mt-8 gap-16">
    <livewire:admin.global.header
        title="{{$title}}"
    />
    <main class="grid grid-cols-10 gap-4">
        {{$slot}}
    </main>
</div>
@livewireScripts
</body>
</html>
