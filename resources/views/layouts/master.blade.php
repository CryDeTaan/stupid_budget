<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Styles -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.1/css/bulma.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        </script>


    </head>
    <body>

        <div id="app">

            @include('layouts.header')

            <section class="section">
                <div class="container">
                    <router-view></router-view>
                </div>
            </section>





        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>
