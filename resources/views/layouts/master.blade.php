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
        let leftHeading = document.querySelectorAll('.heading-left');
        let rightHeading = document.querySelectorAll('.heading-right');

        TweenMax.staggerFromTo(leftHeading, 2, {x:+300, opacity:0}, {x:0, opacity:1});
        TweenMax.staggerFromTo(rightHeading, 2, {x:-300, opacity:0}, {x:0, opacity:1} );
    }

    function setButtonMargin() {

        let galleryHeight = document.querySelector('#galleryHeight').clientHeight;
        let buttonHeight = document.querySelector('#buttonLeft').clientHeight / 2;
        let buttonLeftPosition = document.querySelector('#buttonLeft');
        let buttonRightPosition = document.querySelector('#buttonRight');
        let buttonMargin = -(galleryHeight / 2) - buttonHeight;

        buttonLeftPosition.style.marginTop = buttonMargin + "px";
        buttonRightPosition.style.marginTop = buttonMargin + "px";

    }

    let images = document.querySelectorAll('.gallery-image');
    let currentImage = 0;
    let maxImage = images.length;
    let imageWidth = (document.querySelector('#imageWidth').clientWidth + 2);
    let gallery = document.querySelector('#galleryHeight');

    console.log(maxImage + " maxImage");

    function moveLeft() {

        currentImage = currentImage > 0 ? currentImage - 1 : currentImage;


//        console.log(currentImage + " currentImage left");

        moveGalleryTrack();
        toggleClass();

    }

    function moveRight() {

        currentImage = currentImage < maxImage ? currentImage + 1 : currentImage;

//        console.log(currentImage + " currentImage right");

        moveGalleryTrack();
        toggleClass();
    }

    function moveGalleryTrack() {

        if ( currentImage === maxImage ) {

            currentImage--;

        }

        for (let i=0; i < maxImage; i++) {

            images[i].removeAttribute('gallery-image--fade');

        }

//        console.log(imageWidth + " imageWidth");
//        console.log(currentImage + " currentImage");

        let pos = - (imageWidth * currentImage) + 'px';
        console.log(imageWidth + " image width");
        console.log(pos);

        TweenMax.to(gallery, 1, {
            x: pos,
            onComplete: function() {
                addFade();
            }
        })
    }

    function toggleClass() {

        console.log('toggleClass');

    }

    function addFade() {

        console.log('addFade');

    }


    document.addEventListener('DOMContentLoaded', function() {
        executeTween();
        setButtonMargin();
    }, false);

</script>

</body>
</html>
