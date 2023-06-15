<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    @if (! empty(settings('logo.light')))
        <link rel="icon" href="{{ image_uri(settings('logo.light'), 'favicon-32x32') }}" sizes="32x32" />
        <link rel="icon" href="{{ image_uri(settings('logo.light'), 'favicon-192x192') }}" sizes="192x192" />
        <link rel="apple-touch-icon" href="{{ image_uri(settings('logo.light'), 'favicon-apple-touch-180x180') }}" />
    @endif

    <link rel="stylesheet" href="{{ asset('auth/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
    <link href="{{ asset('web/css/on3step-style.css') }}" rel="stylesheet">
    <title>{{ __('Page not found...') }} | {{ config('app.name') }}</title>
    <style>
        .half .contents {
            background: #ffffff;
        }
        .devider {
            display: block;
            border-top: 1px solid #3ab0ff;
            width: 38px;
            margin-top: 5px;
            margin-bottom: 10px;
            text-align: left;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        .link-class {
            display: block;
            font-size: 9pt;
            margin: 0 auto;
            width: fit-content;
        }
    </style>
</head>
<body>
<div class="d-md-flex half">
    <div class="contents">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12">
                    <div class="login-logo-container mb-3">
                        <a href="{{ route('page') }}">
                            <img src="{{ asset('images/logo-dark.png') }}" width="150" class="auth-logo" />
                        </a>

                        <div style="font-size: 2em;margin: 30px 0">{{ __('Page not found...') }}</div>

                        <a class="link-class" href="{{ route('page') }}">
                            {{ __('To Home') }}
                            <span class="devider"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
