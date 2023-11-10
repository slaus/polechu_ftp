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
                                    <a href="https://t.me/NatalkaUkra" target="_blank" rel="nofollow"><span>{{ settings('company.phone') }}</span></a>
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
                                @if ($item['icon'] == 'telegram')
                                    <a href="{{ $item['url'] }}" title="{{ translation($item['name'] ?? []) }}" style="width: 31px; height: 32px; background: white; display: inline-block; padding: 7px" rel="nofollow" target="_blank">
                                        <svg class="social-header" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0,0,256,256">
                                            <g fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M39.17578,7.01563c-1.368,0 -3.01486,0.44161 -5.50586,1.47461l-0.30078,0.12305c-3.805,1.58 -7.47827,3.11803 -10.94727,4.58203c-0.556,0.235 -0.91016,0.77686 -0.91016,1.38086c0,1.073 1.09694,1.79786 2.08594,1.38086c5.659,-2.388 10.1727,-4.25836 11.2207,-4.69336c1.928,-0.801 3.36042,-1.24609 4.35742,-1.24609c1.687,0 2.12986,1.27548 1.63086,4.27148c-0.309,1.852 -0.93248,6.01927 -1.64648,10.57227c-0.143,0.91 0.56042,1.73633 1.48242,1.73633h0.00195c0.738,0 1.36842,-0.53953 1.48242,-1.26953c0.31,-1.976 0.60423,-3.88694 0.86523,-5.58594c0.331,-2.156 0.60239,-3.92394 0.77539,-4.96094c0.349,-2.095 0.50973,-4.46655 -0.94727,-6.18555c-0.612,-0.72 -1.73953,-1.58008 -3.64453,-1.58008zM16.37305,15.96289c-0.24281,-0.0253 -0.49664,0.00948 -0.74414,0.11523c-3.5,1.496 -6.67711,2.86927 -9.41211,4.07227c-1.074,0.473 -4.33989,1.91002 -4.21289,4.91602c0.054,1.297 0.76747,3.066 3.85547,4.125l0.22852,0.07813c0.862,0.297 2.65609,0.91631 4.49609,1.44531c1.12,0.322 2.1328,0.47656 3.0918,0.47656c1.664,0 2.95294,-0.47434 3.96094,-1.02734c-0.005,0.168 -0.00128,0.33781 0.01172,0.50781c0.182,2.312 1.96911,3.57989 3.03711,4.33789l0.15039,0.10547c1.577,1.128 8.71348,5.842 9.52148,6.375c1.521,1.004 2.89422,1.49219 4.19922,1.49219c2.052,0 4.70188,-1.09636 5.67188,-6.31836c0.257,-1.384 0.52688,-2.9213 0.79688,-4.5293c0.154,-0.915 -0.55052,-1.75195 -1.47852,-1.75195c-0.732,0 -1.35947,0.528 -1.48047,1.25c-0.268,1.596 -0.53311,3.12037 -0.78711,4.48438c-0.502,2.702 -1.40761,3.86719 -2.72461,3.86719c-0.724,0 -1.57092,-0.35114 -2.54492,-0.99414c-1.32,-0.872 -7.98464,-5.27945 -9.43164,-6.31445c-1.32,-0.943 -3.14142,-2.0785 -0.85742,-4.3125c0.813,-0.796 6.14102,-5.8828 10.29102,-9.8418c0.443,-0.423 0.07208,-1.06836 -0.41992,-1.06836c-0.112,0 -0.23166,0.03433 -0.34766,0.11133c-5.594,3.71 -13.35089,8.86025 -14.33789,9.53125c-0.987,0.67 -1.94847,1.09961 -3.23047,1.09961c-0.655,0 -1.39467,-0.11328 -2.26367,-0.36328c-1.943,-0.558 -3.84108,-1.22256 -4.58008,-1.47656c-2.845,-0.976 -2.16925,-2.24103 0.59375,-3.45703c2.995,-1.317 6.22667,-2.7105 9.38867,-4.0625c0.552,-0.236 0.9082,-0.77791 0.9082,-1.37891v-0.00195c0,-0.807 -0.62117,-1.4163 -1.34961,-1.49219z"></path></g></g>
                                        </svg>
                                    </a>
                                @elseif ($item['icon'] == 'viber')
                                    <a href="{{ $item['url'] }}" title="{{ translation($item['name'] ?? []) }}" style="width: 31px; height: 32px; background: white; display: inline-block; padding: 8px" rel="nofollow" target="_blank">
                                        <svg class="social-header" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                             viewBox="0 0 52.511 52.511" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M31.256,0H21.254C10.778,0,2.255,8.521,2.255,18.995v9.01c0,7.8,4.793,14.81,12,17.665v5.841
                                                        c0,0.396,0.233,0.754,0.595,0.914c0.13,0.058,0.268,0.086,0.405,0.086c0.243,0,0.484-0.089,0.671-0.259L21.725,47h9.531
                                                        c10.476,0,18.999-8.521,18.999-18.995v-9.01C50.255,8.521,41.732,0,31.256,0z M48.255,28.005C48.255,37.376,40.63,45,31.256,45
                                                        h-9.917c-0.248,0-0.487,0.092-0.671,0.259l-4.413,3.997v-4.279c0-0.424-0.267-0.802-0.667-0.942
                                                        C8.81,41.638,4.255,35.196,4.255,28.005v-9.01C4.255,9.624,11.881,2,21.254,2h10.002c9.374,0,16.999,7.624,16.999,16.995V28.005z"
                                                    />
                                                    <path d="M39.471,30.493l-6.146-3.992c-0.672-0.437-1.472-0.585-2.255-0.423c-0.784,0.165-1.458,0.628-1.895,1.303l-0.289,0.444
                                                        c-2.66-0.879-5.593-2.002-7.349-7.085l0.727-0.632h0c1.248-1.085,1.379-2.983,0.294-4.233l-4.808-5.531
                                                        c-0.362-0.417-0.994-0.46-1.411-0.099l-3.019,2.624c-2.648,2.302-1.411,5.707-1.004,6.826c0.018,0.05,0.04,0.098,0.066,0.145
                                                        c0.105,0.188,2.612,4.662,6.661,8.786c4.065,4.141,11.404,7.965,11.629,8.076c0.838,0.544,1.781,0.805,2.714,0.805
                                                        c1.638,0,3.244-0.803,4.202-2.275l2.178-3.354C40.066,31.413,39.934,30.794,39.471,30.493z M35.91,34.142
                                                        c-0.901,1.388-2.763,1.782-4.233,0.834c-0.073-0.038-7.364-3.835-11.207-7.75c-3.592-3.659-5.977-7.724-6.302-8.291
                                                        c-0.792-2.221-0.652-3.586,0.464-4.556l2.265-1.968l4.152,4.776c0.369,0.424,0.326,1.044-0.096,1.411l-1.227,1.066
                                                        c-0.299,0.26-0.417,0.671-0.3,1.049c2.092,6.798,6.16,8.133,9.13,9.108l0.433,0.143c0.433,0.146,0.907-0.021,1.155-0.403
                                                        l0.709-1.092c0.146-0.226,0.37-0.379,0.63-0.434c0.261-0.056,0.527-0.004,0.753,0.143l5.308,3.447L35.91,34.142z"/>
                                                    <path d="M28.538,16.247c-0.532-0.153-1.085,0.156-1.236,0.688c-0.151,0.531,0.157,1.084,0.688,1.235
                                                        c1.49,0.424,2.677,1.613,3.097,3.104c0.124,0.44,0.525,0.729,0.962,0.729c0.09,0,0.181-0.012,0.272-0.037
                                                        c0.531-0.15,0.841-0.702,0.691-1.234C32.405,18.578,30.69,16.859,28.538,16.247z"/>
                                                    <path d="M36.148,22.219c0.09,0,0.181-0.012,0.272-0.037c0.532-0.15,0.841-0.703,0.691-1.234c-1.18-4.183-4.509-7.519-8.689-8.709
                                                        c-0.531-0.153-1.084,0.158-1.235,0.689c-0.151,0.531,0.157,1.084,0.688,1.235c3.517,1,6.318,3.809,7.311,7.328
                                                        C35.311,21.931,35.711,22.219,36.148,22.219z"/>
                                                    <path d="M27.991,7.582c-0.532-0.153-1.085,0.156-1.236,0.689c-0.151,0.531,0.157,1.084,0.688,1.235
                                                        c5.959,1.695,10.706,6.453,12.388,12.416c0.124,0.44,0.525,0.729,0.962,0.729c0.09,0,0.181-0.012,0.272-0.037
                                                        c0.531-0.15,0.841-0.703,0.691-1.234C39.887,14.753,34.613,9.467,27.991,7.582z"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ $item['url'] }}" title="{{ translation($item['name'] ?? []) }}" rel="nofollow" target="_blank">
                                        <i class="{{ $item['icon'] }}"></i>
                                    </a>
                                @endif
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
