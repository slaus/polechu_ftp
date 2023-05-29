<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
    <title>{{ trans('Login') }} | {{ config('app.name') }}</title>
</head>
<body>
    <div class="d-md-flex half">
        <div class="contents">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12">
                        <div class="login-logo-container mb-3">
                            <a href="{{ route('page') }}">
                                <img src="{{ asset('images/logo.png') }}" width="150" class="auth-logo" />
                            </a>
                        </div>

                        <div class="form-block mx-auto pt-4">
                            <form action="{{ route('login') }}" method="post">
                                @csrf

                                <div class="form-group first">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ old('email') }}" id="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group last mb-3">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" id="password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <div class="d-sm-flex align-items-center">
                                        <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">{{ __('Remember Me') }}</span>
                                            <input type="checkbox" name="remember" checked="checked" value="1" />
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>

                                    <input type="submit" value="{{ __('Log in') }}" class="btn btn-block btn-login py-2 btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
