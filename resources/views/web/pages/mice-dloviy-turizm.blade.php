@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@push('styles')
    <style>
        .white nav a {
            color: #707070!important;
            text-shadow: none!important;
        }
        .white nav a:hover {
            color: #505050 !important;
        }
        .white nav a.actived {
            color: #505050 !important;
        }
    </style>
@endpush

@push('scripts')
{{--    <script src="{{ asset('js/site.js') }}?v=2" type="text/javascript"></script>--}}
@endpush

@section('content')
    @if (! empty($content['banner']['items']))
        <div class="bgslider-owl" id="home">
            <div id="owl-slider-home" class="owl-carousel">
                @foreach($content['banner']['items'] as $item)
                    @continue(empty($item['image']))
                    <div class="item imgbg banner-item" data-bg-src="{{ image_uri($item['image']) }}">
                        <div class="overlay-main v-align text-center ">
                            <div class="col-md-10 col-xs-11 onStep" data-animation="fadeInUp" data-time="300">
                                @if (! empty($item['title']))
                                    <h1 class="home-title-h1 title-h">{!! translation($item['title']) !!}</h1>
                                @endif

                                @if (! empty($item['subtitle']))
                                    <div class="home-title-h3 title-h">{!! translation($item['subtitle']) !!}</div>
                                @endif

                                @if ((int) ($item['stars']) > 0)

                                    <div class="star-content">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star{{ $i <= (int) $item['stars'] ? '' : '-o' }}" aria-hidden="{{ $i <= (int) $item['stars'] ? 'true' : 'false' }}"></i>
                                        @endfor
                                        {!! translation($item['name'] ?? []) !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const bannerItems = document.querySelectorAll('.banner-item');
                Array.from(bannerItems).forEach(item => {
                    item.style.background = 'url("' + item.getAttribute('data-bg-src') + '")';
                    item.style.backgroundSize = 'cover';
                });
            }, false);
        </script>
    @endif

    <section style="margin-top: 40px; margin-bottom: 40px">
        <div class="container">
            <img loading="lazy" class="white" alt="logo" src="{{ image_uri(settings('logo.light'), '100') }}">
        </div>
    </section>

    <section>
        <div class="container">
            {!! translation($content['seo']['text']) !!}
        </div>
    </section>
@endsection
