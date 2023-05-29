<header class="init">
    <div class="subnav">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <div class="social-icons-subnav">
                            <div><i class="ti-mobile"></i>+02151 7778 009</div>
                            <div><i class="ti-email"></i><a href= "mailto:companyname@gmail.com">contact@luxury.com</a></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="right">
                        <div class="social-icons-subnav">
                            <a href="#"><span class="ti-facebook"></span></a>
                            <a href="#"><span class="ti-dribbble"></span></a>
                            <a href="#"><span class="ti-twitter"></span></a>
                            <a  href="#"><span class="ti-instagram"></span></a>
                            <a href="#"><span class="ti-linkedin"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar-default-white navbar-fixed-top">
        <div class="container">
            <div class="row">
                <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <a class="navbar-brand white" href="/">
                    <img class="white" alt="logo" src="/web/img/logo-white.png">
                    <img class="black" alt="logo" src="/web/img/logo-black.png">
                </a>

                <div class="white menu-init" id="main-menu">
                    <nav id="menu-center">
                        <ul>
                            <li>
                                <a class="actived" href="{{ route('page') }}">{{ __('Home') }}</i></a>
                            </li>
                            <li>
                                <a href="{{ route('page', 'about') }}">{{ __('About') }}</i></a>
                            </li>
                            <li>
                                <a href="{{ route('page', 'blog') }}">{{ __('Blog') }}</i></a>
                            </li>
                            <li>
                                <a href="{{ route('page', 'contacts') }}">{{ __('Contacts') }}</i></a>
                            </li>

                            @if (! empty(config('localizations.supported_locales')))
                                <li>
                                    <a  href="#">
                                        {{ config('localizations.supported_locales', [])[app()->getLocale()]['native'] ?? app()->getLocale() }}
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul>
                                        @foreach(config('localizations.supported_locales', []) as $code => $localization)
                                            <li style="width: fit-content"><a href="{{ route('locale', $code) }}">{{ $localization['native'] ?? $code }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif

                            <li>
                                <form role="search">
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control" placeholder="SEARCH">
                                        <div class="input-group-btn">
                                            <button type="submit"><span class="icon"><i class="fa fa-search"></i></span></button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

{{--    @if (Route::has('login'))--}}
{{--        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">--}}
{{--            @auth--}}
{{--                <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>--}}
{{--            @else--}}
{{--                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>--}}

{{--                @if (Route::has('register'))--}}
{{--                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>--}}
{{--                @endif--}}
{{--            @endauth--}}
{{--        </div>--}}
{{--    @endif--}}
</header>
