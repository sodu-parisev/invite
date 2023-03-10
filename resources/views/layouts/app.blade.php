<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('Admin panel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
    </head>
    <body>
        <div class="container-fluid pt-5">
            <h1>
                {{ __('Dashboard') }}
            </h1>
            <div class="row">
                <div class="col-sm-3">
                    @include('layouts.navigation')
                </div>
                <div class="col-sm-9">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
