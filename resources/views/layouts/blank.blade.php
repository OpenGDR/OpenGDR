<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'OpenGDR') }}</title>


        @if(env('FONT_AWESOME_CODE'))
        <script src="https://kit.fontawesome.com/{{ env('FONT_AWESOME_CODE') }}.js" crossorigin="anonymous"></script>
        @endif

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        @yield('layoutContent')

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </body>

</html>
