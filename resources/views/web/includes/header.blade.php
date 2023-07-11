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
                                    <span>{{ settings('company.phone') }}</span>
                                </div>
                            @endif

                            @if(! empty(settings('company.email')))
                                <div>
                                    <i class="ti-email"></i>
                                    <a href="mailto:{{ settings('company.email') }}"><span>{{ settings('company.email') }}</span></a>
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
                                    <i class="{{ $item['icon'] }}"></i>
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
                    <x-menu-component layout="main" />
                </div>
            </div>
        </div>
    </div>
</header>
