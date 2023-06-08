<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">

    @if (! empty(settings('logo.light')))
        <link rel="icon" href="{{ image_uri(settings('logo.light'), 'favicon-32x32') }}" sizes="32x32" />
        <link rel="icon" href="{{ image_uri(settings('logo.light'), 'favicon-192x192') }}" sizes="192x192" />
        <link rel="apple-touch-icon" href="{{ image_uri(settings('logo.light'), 'favicon-apple-touch-180x180') }}" />
    @endif

    <!-- Bootstrap CSS -->
    <link href="{{ asset('web/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('web/css/jquery.dateselect.css') }}">
    <!-- font themify CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/themify-icons.css') }}">
    <!-- font awesome CSS -->
    <link href="{{ asset('web/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <!-- on3step CSS -->
    <link href="{{ asset('web/css/animated-on3step.css') }}" rel="stylesheet">
    <link href="{{ asset('web/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('web/css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('web/css/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('web/css/on3step-style.css') }}" rel="stylesheet">
    <link href="{{ asset('web/css/queries-on3step.css') }}" media="all" rel="stylesheet" type="text/css">

    <style>
        strong {
            font-weight: bold !important;
        }
        em {
            font-style: italic !important;
        }
        /*ul, ol {*/
        /*    list-style: initial;*/
        /*    margin-left: 15px;*/
        /*}*/
        /*ul li {*/
        /*    list-style: initial;*/
        /*}*/
        /*ol li {*/
        /*    list-style: decimal;*/
        /*}*/
        .success {
            color: #0F6400FF !important;
            font-size: 14px;
        }
        .error {
            color: #FF0000FF !important;
            font-size: 14px;
        }
        .title-h {
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .title-h1 {
            font-size: 36px;
            font-weight: 500;
            line-height: normal;
            text-transform: uppercase;
        }
        .home-title-h1 {
            font-size: 44pt;
            letter-spacing: 2px;
            font-weight: 500;
            line-height: normal;
            text-transform: uppercase;
        }
        .title-h2 {
            font-size: 30pt;
            font-weight: 400;
            line-height: normal;
        }
        .title-h3 {
            font-size: 17px;
            font-weight: 400;
            text-transform: none;
            line-height: normal;
        }
        .home-title-h3 {
            font-size: 40pt;
            font-weight: 500;
            letter-spacing: 1px;
            line-height: normal;
        }
        .title-h5 {
            font-size: 14pt;
            font-weight: 500;
        }

        .subscribe-section .title-h2 {
            text-transform: none;
            font-weight: 600;
            width: 7em;
            word-wrap: break-word;
            line-height: 40pt;
        }
        .wrap-news .title-h3 {
            display: block;
            font-size: 13pt;
            font-weight: 500;
            text-transform: uppercase;
            margin: 15px 0 10px 0;
        }
        #subheader .title-h1 {
            color: #fefefe;
            text-align: center;
            margin-top: 40px;
            font-size: 32px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .whitepage .title-h2 {
            font-size: 22px;
            font-weight: 500;
            text-transform: none;
        }
        .navbar-brand.white .white {
            max-height: 100px!important;
        }
        .navbar-brand.white .black {
            max-height: 50px!important;
        }
        .preview-price {
            font-size: 28px;
            color: #ffb600;
            font-weight: bold;
            margin-top: 16px;
        }
        .preview-price sub {
            font-size: 14px;
            font-weight: normal;
        }
    </style>

    @stack('meta')
    @stack('styles')
</head>
<body>
<!-- preloader -->
<div class="bg-preloader-white"></div>
<div class="preloader-white">
    <div class="mainpreloader">
        <span></span>
    </div>
</div>
<!-- preloader end -->

<div class="content-wrapper">
    @include('web.includes.header')
    @yield('content')
    @include('web.includes.footer')
</div>

<script src="{{ asset('web/plugin/pluginson3step.js') }}" type="text/javascript"></script>
<script src="{{ asset('web/plugin/sticky.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('web/js/jquery.dateselect.js') }}"></script>
<!-- slider revolution  -->
<script type="text/javascript" src="{{ asset('web/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
<!-- on3step JS -->
<script src="{{ asset('web/js/on3step.js') }}" type="text/javascript"></script>
<script src="{{ asset('web/js/plugin-set.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

@stack('scripts')
</body>
</html>
