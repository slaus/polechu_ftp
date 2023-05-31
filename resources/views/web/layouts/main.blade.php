<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <!-- favicon -->
    <link href="{{ asset('web/img/favicon.png') }}" rel="icon" sizes="32x32" type="image/png">
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
        ul, ol {
            list-style: initial;
            margin-left: 15px;
        }
        ul li {
            list-style: initial;
        }
        ol li {
            list-style: decimal;
        }
        .success {
            color: #0F6400FF !important;
            font-size: 14px;
        }
        .error {
            color: #FF0000FF !important;
            font-size: 14px;
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
