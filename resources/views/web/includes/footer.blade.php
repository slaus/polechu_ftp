<section aria-label="footer" class="subfooter">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-12">
                @if (! empty(settings('logo.white')))
                    <div class="logo">
                        <img alt="logo" src="{{ image_uri(settings('logo.white'), '160') }}">
                    </div>
                @endif

                @if (! empty(settings('company.description')))
                    <p>{{ translation(settings('company.description')) }}</p>
                @endif
            </div>


            <div class="col-md-4 col-xs-12 col-md-offset-1">
                <h3>
                    CONTACT INFO
                </h3>

                <address>
                    <span>129 Park street, New York City, NY 10903</span> <span>PHONE: (+6221) 000 888 999</span> <span>EMAIL : <a href=
                                                                                                                                       "mailto:companyname@gmail.com">companyname@gmail.com</a></span> <span>SITE : <a href="#">www.companyname.com</a></span>
                </address>
            </div>

            <div class="col-md-3 col-xs-12 pull-right">
                <h3>
                    PHOTO STREAM
                </h3>
                <div id="flickr-photo-stream">
                    <div class="clearfix">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<footer class="white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
               {!! __('&copy; :company :year. all reserved design by on3step', ['company' => config('app.name'), 'year' => date('Y')]) !!}
            </div>

            <div class="col-md-6">
                <div class="right">
                    <div class="social-icons">
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
</footer>

<div id="totop">
    <span class="ti-angle-up"></span>
</div>
