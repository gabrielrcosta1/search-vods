<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme()"
    x-bind:class="{ 'dark bg-gray-700': darkTheme, 'bg-white': !darkTheme }"">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Pesquisa de Vods') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    {{-- Also insert this code  --}}
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <tallstackui:setup />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <div class="min-h-full">
        @include('components.headers')
        @yield('content')
        <x-toast />
    </div>

    @livewireScripts
</body>

</html>
