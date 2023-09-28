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
                                    <a href="https://t.me/ulechukudahochy" target="_blank" rel="nofollow"><span>{{ settings('company.phone') }}</span></a>
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
            <div class="row mobile-header">
                <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <div class="search-tour-button" style="max-width: 200px;">
                    <button id="searchTourMainButton" class="btn-form" style="background: #ffb600; line-height: 24px; height: 30px; padding: 0 5px; margin: 0; font-size: 10px">
                        {{ __('Search tour') }}
                    </button>

                    @if(! empty(settings('company.phone')))
                        <a href="tel:{{ settings('company.phone') }}" class="btn-form" style="background: #ffb600; line-height: 24px; height: 30px; padding: 0 5px; margin: 0 0 0 5px; width: 30px; color: #ffffff" title="{{ settings('company.phone') }}" rel="nofollow">
                            <img src="/images/phone.svg" width="15" alt="phone" />
                        </a>
                    @endif

                    @if(! empty(settings('company.email')))
                        <a href="mailto:{{ settings('company.email') }}" class="btn-form" style="background: #ffb600; line-height: 24px; height: 30px; padding: 0 5px; margin: 0 0 0 5px; width: 30px; color: #ffffff" title="{{ settings('company.email') }}" rel="nofollow">
                            <img src="/images/mail.svg" width="15" alt="mail" />
                        </a>
                    @endif
                </div>

                <a class="navbar-brand white" href="{{ route('page') }}">
                    @if (! empty(settings('logo.light')))
                        <img loading="lazy" class="white" alt="logo" src="{{ image_uri(settings('logo.light'), '100') }}">
                    @endif

                    @if (! empty(settings('logo.dark')))
                        <img loading="lazy" class="black" alt="logo" src="{{ image_uri(settings('logo.dark'), '50') }}">
                    @endif
                </a>

                <div class="white menu-init" id="main-menu">
                    <x-menu-component layout="main" />
                </div>
            </div>
        </div>
    </div>
</header>
