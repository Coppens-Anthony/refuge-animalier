<!doctype html>
<html lang="{!! App::getLocale() !!}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? '' }} - {{ config('app.name', 'Les pattes heureuses') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins bg-gray-50">
<h1 class="sr-only">{{__('global.admin')}}</h1>

<div class="flex min-h-screen">
    <livewire:admin.global.nav/>

    <div class="flex-1 w-full lg:ml-48">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
            <livewire:admin.global.header title="{{$title}}"/>

            <main class="mb-8">
                {{$slot}}
            </main>
        </div>
    </div>
</div>

</body>
</html>
