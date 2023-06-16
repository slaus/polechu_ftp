@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@push('styles')

@endpush

@push('scripts')

@endpush

@section('content')
    <section id="subheader" style="background: url('/images/original/media/banners/bg-subheader.jpg') top fixed">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-h1 title-h">{{ translation($tour['name'] ?? []) }}</div>
                </div>

                <div class="col-md-12">
                    <div class="devider-page">
                        <div class="devider-img-right">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <ul class="subdetail">
                        <li>
                            <a href="{{ route('page') }}">{{ __('Home') }}</a>
                        </li>

                        <li class="sep">/</li>

                        <li>{{ translation($tour['name'] ?? []) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="room-detail whitepage">
        <div class="onStep" data-animation="fadeInUp" data-time="300">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="detaillist">
                            <div class="title-h2 title-h">{{ translation($tour['name'] ?? []) }}</div>

                            <div class="devider-rooms-detail"></div>

                            {!! translation($tour['content'] ?? []) !!}

                            <div class="price">{!! translation($tour['price'] ?? []) !!}</div>
                        </div>
                    </div>

                    @if (! empty($tour['gallery']))
                        <div class="col-md-8">
                            <div id="roomsBig" class="owl-carousel">
                                @foreach($tour['gallery'] as $image)
                                    <div class="item"><img alt="img" src="{{ image_uri($image, '1280') }}"></div>
                                @endforeach
                            </div>

                            <div id="roomsSmall" class="owl-carousel">
                                @foreach($tour['gallery'] as $image)
                                    <div class="item"><img alt="img" src="{{ image_uri($image, '160') }}"></div>
                                @endforeach
                            </div>
                        </div>

                        <div class="space-single"></div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
