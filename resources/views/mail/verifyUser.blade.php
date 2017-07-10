<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <link href="https://www.stupidbudget.com/css/app.css" rel="stylesheet">

    <title>{{ config('app.name') }}</title>


</head>
<body>

<br/>

    <div class="container">

        <p class="title has-text-centered">
            <a href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
        </p>

        <p class="has-text-centered">Hi {{ $user->name }}, you are required to verify your account.</p>

        <br/>

        <p class="has-text-centered">

            <a class="button is-primary is-outlined has-text-centered" href='{{ url("register/confirm/{$user->verifiedToken}") }}'>Confirm email</a>

        </p>


    </div>

<br/>

<div class="container is-fluid">
    <div class="has-text-centered">
        <p>
            <strong>Stupid Budget</strong> by <a href="https://living-stratus.com">Living Stratus</a>
        </p>
        <p>
            &copy; Living Stratus 2017
        </p>
    </div>
</div>


</body>
</html>
