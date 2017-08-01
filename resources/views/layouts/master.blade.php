<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>{{ config('app.name') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script>

        // Google Analytics

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-103335841-1', 'auto');
        ga('send', 'pageview');



        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>


</head>
<body>

@include('layouts.header')

<section class="section">

    @if (Request::is('login') or Request::is('register') or Request::is('password/*'))
        @yield('content')
    @else
        @include('layouts.app')
    @endif

</section>

@include('layouts.footer')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">

    function executeTween() {
        var leftHeading = document.getElementsByClassName('heading-left');
        var rightHeading = document.getElementsByClassName('heading-right');

        TweenMax.staggerFromTo(leftHeading, 2, {x:+300, opacity:0}, {x:0, opacity:1});
        TweenMax.staggerFromTo(rightHeading, 2, {x:-300, opacity:0}, {x:0, opacity:1} );
    }

    function setButtonMargin() {

        var galleryHeight = document.getElementById('galleryHeight').clientHeight;
        var buttonHeight = document.getElementById('buttonLeft').clientHeight / 2;
        var buttonLeftPosition = document.getElementById('buttonLeft');
        var buttonRightPosition = document.getElementById('buttonRight');
        var buttonMargin = -(galleryHeight / 2) - buttonHeight;

        buttonLeftPosition.style.marginTop = buttonMargin + "px";
        buttonRightPosition.style.marginTop = buttonMargin + "px";

    }

    function moveLeft() {
        console.log('left')

    }

    function moveRight() {
        console.log('right')
    }


    document.addEventListener('DOMContentLoaded', function() {
        executeTween();
        setButtonMargin();
    }, false);

</script>

</body>
</html>
