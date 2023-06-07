<header class="init">
    <div class="subnav">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <div class="social-icons-subnav">
                            @if(! empty(settings('company.phone')))
                                <div>
                                    <i class="ti-mobile"></i>
                                    {{ settings('company.phone') }}
                                </div>
                            @endif

                            @if(! empty(settings('company.email')))
                                <div>
                                    <i class="ti-email"></i>
                                    <a href="mailto:{{ settings('company.email') }}">{{ settings('company.email') }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="right">
                        <div class="social-icons-subnav">
                            @foreach(settings('socials', []) as $item)
                                <a href="{{ $item['url'] }}" title="{{ translation($item['name'] ?? []) }}" rel="nofollow" target="_blank">
                                    <span class="{{ $item['icon'] }}"></span>
                                </a>
                            @endforeach
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

                <a class="navbar-brand white" href="{{ route('page') }}">
                    @if (! empty(settings('logo.light')))
                        <img class="white" alt="logo" src="{{ image_uri(settings('logo.light'), '160') }}">
                    @endif

                    @if (! empty(settings('logo.dark')))
                        <img class="black" alt="logo" src="{{ image_uri(settings('logo.dark'), '160') }}">
                    @endif
                </a>

                <div class="white menu-init" id="main-menu">
                    <nav id="menu-center">
                        <ul>
                            <li>
                                <a href="{{ route('page') }}" @if(route('page') == url()->current()) class="actived" @endif>{{ __('Home') }}</i></a>
                            </li>
                            <li>
                                <a href="{{ route('page', 'about') }}" @if(route('page', 'about') == url()->current()) class="actived" @endif>{{ __('About') }}</i></a>
                            </li>
                            <li>
                                <a href="{{ route('page', 'blog') }}" @if(route('page', 'blog') == url()->current()) class="actived" @endif>{{ __('Blog') }}</i></a>
                            </li>
                            <li>
                                <a href="{{ route('page', 'contacts') }}" @if(route('page', 'contacts') == url()->current()) class="actived" @endif>{{ __('Contacts') }}</i></a>
                            </li>

{{--                            @if (! empty(config('localizations.supported_locales')))--}}
{{--                                <li>--}}
{{--                                    <a  href="#">--}}
{{--                                        {{ config('localizations.supported_locales', [])[app()->getLocale()]['native'] ?? app()->getLocale() }}--}}
{{--                                        <i class="fa fa-angle-down"></i>--}}
{{--                                    </a>--}}
{{--                                    <ul>--}}
{{--                                        @foreach(config('localizations.supported_locales', []) as $code => $localization)--}}
{{--                                            <li style="width: fit-content"><a href="{{ route('locale', $code) }}">{{ $localization['native'] ?? $code }}</a></li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                            @endif--}}

                            <li>
                                <form role="search" action="{{ route('page', 'blog') }}" method="get">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="{{ __('SEARCH') }}">
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
</header>
