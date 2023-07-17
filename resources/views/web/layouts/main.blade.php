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

    <style>
        /* preloader */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 99999;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-flow: row nowrap;
            -ms-flex-flow: row nowrap;
            flex-flow: row nowrap;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            background: #0d0d0d;
        }
        .preloader-white {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 99999;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-flow: row nowrap;
            -ms-flex-flow: row nowrap;
            flex-flow: row nowrap;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            background: #fff;
        }
        .mainpreloader {
            position: relative;
            animation: rotate 1s infinite linear;
            border: 3px solid #ebebeb;
            width: 40px;
            height: 40px;
            margin-right: -24px;
            border-radius: 999px;
        }
        .mainpreloader span {
            position: absolute;
            width: 40px;
            height: 40px;
            border: 3px solid transparent;
            border-top: 3px solid #3ab0ff;
            top: -3px;
            left: -3px;
            border-radius: 999px;
        }
    </style>

    @stack('meta')
    @stack('styles')

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-K5V82FJLBW"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-K5V82FJLBW');
    </script>
</head>
<body>
<div class="bg-preloader-white"></div>
<div class="preloader-white">
    <div class="mainpreloader">
        <span></span>
    </div>
</div>

<div class="content-wrapper">
    @include('web.includes.header')
    @yield('content')
    @include('web.includes.footer')
</div>

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
    h1.home-title-h1 {
        font-size: 32pt!important;
        letter-spacing: 2px!important;
        font-weight: 500!important;
        line-height: normal!important;
        text-transform: uppercase!important;
        margin-top: 20px!important;
        margin-bottom: 10px!important;
        text-shadow: 1px 1px 2px rgba(0,0,0,.5)!important;
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
        font-size: 24pt;
        font-weight: 500;
        letter-spacing: 1px;
        line-height: normal;
        margin-top: 5px;
    }
    .post-title-h3 {
        margin: 20px 0 -10px 0;
        font-size: 16pt;
        font-weight: 500;
    }
    .title-h5 {
        font-size: 14pt;
        font-weight: 500;
    }
    .title-h6 {
        font-size: 14px!important;
        font-weight: 500!important;
        margin-top: 0!important;
        margin-bottom: 10px!important;
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
    #menu-center ul, #menu-center ul li {
        list-style: none !important
    }
    .container ul, .container ul li {
        list-style: initial !important
    }
    .container ol, .container ol li {
        list-style: decimal !important
    }
    .container ul, .container ol {
        margin-left: 30px;
    }
    .bot-home-text {
        z-index: 99!important;
    }
    /* CHROME SCROLLBAR */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #cccccc;
        border-radius: 4px;
    }

    /* FIREFOX SCROLLBAR */
    * {
        scrollbar-width: thin;
        scrollbar-color: #cccccc #f1f1f1;
    }

    *::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #cccccc;
        border-radius: 4px;
    }
    /* SELECT TOURS POSITION */
    .bot-home-text {
        position: relative;
        top: -400px;
        margin-bottom: -400px;
    }

    @media only screen and (max-width: 1199px) {
        .bot-home-text {
            position: relative;
            top: 0;
            margin-bottom: 0;
        }
    }

    .owl-theme .owl-controls .owl-buttons div {
        z-index: 999 !important;
    }
</style>

<script src="{{ asset('web/plugin/pluginson3step.js') }}"></script>
<script src="{{ asset('web/plugin/sticky.js') }}"></script>
<script src="{{ asset('web/js/jquery.dateselect.js') }}"></script>
<script src="{{ asset('web/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('web/js/on3step.js') }}"></script>
<script src="{{ asset('web/js/plugin-set.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

@stack('scripts')
</body>
</html>
