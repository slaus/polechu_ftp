@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@push('styles')

@endpush

@push('scripts')
    <script src="{{ asset('js/site.js') }}" type="text/javascript"></script>
@endpush

@section('content')
    @if (! empty($content['banner']['items']))
        <div class="bgslider-owl" id="home">
            <div id="owl-slider-home" class="owl-carousel">
                @foreach($content['banner']['items'] as $item)
                    @continue(empty($item['image']))
                    <div class="item imgbg" style="background-image: url('{{ image_uri($item['image']) }}')">
                        <div class="overlay-main v-align text-center ">
                            <div class="col-md-10 col-xs-11 onStep" data-animation="fadeInUp" data-time="300">
                                <div class="home-title-h1 title-h">{!! translation($item['title'] ?? []) !!}</div>
                                <div class="home-title-h3 title-h">{!! translation($item['subtitle'] ?? []) !!}</div>
                                <br>
                                <div class="star-content">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star{{ $i <= (int) $item['stars'] ? '' : '-o' }}" aria-hidden="{{ $i <= (int) $item['stars'] ? 'true' : 'false' }}"></i>
                                    @endfor
                                    {!! translation($item['name'] ?? []) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="bot-home-text onStep" data-animation="fadeInUp" data-time="1200">
        <div class="container">
            <find-tours-component></find-tours-component>
        </div>
    </div>

    @if (! empty(tours((int) ($content['posts']['count'] ?? 3))))
        <section class="whitepage">
            <div class="container-fluid">
                <div class="row">
                    @if (! empty($content['tours']['title']) || ! empty($content['tours']['subtitle']))
                        <div class="col-md-12">
                            <div class="text-center">
                                @if (! empty($content['tours']['title']))
                                    <h2 class="title-h2 title-h">{{ translation($content['tours']['title']) }}</h2>
                                    <span class="devider-center"></span>
                                @endif

                                @if (! empty($content['tours']['subtitle']))
                                    <div class="title-h3 title-h">{{ translation($content['tours']['subtitle']) }}</div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @foreach(tours((int) ($content['posts']['count'] ?? 3)) as $tour)
                        <div class="col-md-4">
                            <div class="wrap-news onStep" data-animation="fadeInLeft" data-time="300">
                                @if (! empty($tour['image']))
                                    <img alt="{{ translation($tour['name'] ?? []) }}" class="img-responsive" src="{{ image_uri($tour['image'], '540') }}">
                                @endif
                                <div class="title-h3 title-h">{{ translation($tour['name'] ?? []) }}</div>
                                <p>{{ translation($tour['description'] ?? []) }}</p>
                                <div class="preview-price">{!! translation($tour['price'] ?? []) !!}</div>
                                <a class="link-class" href="{{ route('tours', $tour['slug']) }}">
                                    {{ __('More detail') }}
                                    <span class="devider"></span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (! empty(posts((int) ($content['posts']['count'] ?? 10))))
        <section class="whitepage" style="padding-top: 0">
            <div class="container">
                <div class="row">
                    @if (! empty($content['posts']['title']) || ! empty($content['posts']['subtitle']))
                        <div class="col-md-12">
                            <div class="text-center">
                                @if (! empty($content['posts']['title']))
                                    <h2 class="title-h2 title-h">{{ translation($content['posts']['title']) }}</h2>
                                    <span class="devider-center"></span>
                                @endif

                                @if (! empty($content['posts']['subtitle']))
                                    <div class="title-h3 title-h">{{ translation($content['posts']['subtitle']) }}</div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="onStep" data-animation="fadeInUp" data-time="300">
                        <div class="owl-carousel" id="owl-post">
                            @foreach(posts((int) ($content['posts']['count'] ?? 10)) as $post)
                                <div class="item">
                                    <div class="wrap-news onStep" data-animation="fadeInLeft" data-time="300">
                                        @if (! empty($post['image']))
                                            <img alt="{{ translation($post['name'] ?? []) }}" class="img-responsive" src="{{ image_uri($post['image'], '540') }}">
                                        @endif
                                        <div class="title-h3 title-h">{{ translation($post['name'] ?? []) }}</div>
                                        <p>{{ translation($post['description'] ?? []) }}</p>
                                        <a class="link-class" href="{{ route('post', $post['slug']) }}">
                                            {{ __('Read more') }}
                                            <span class="devider"></span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="subscribe-section" style="background-image:url('{{ image_uri($content['feedback_form']['background_image'] ?? '') }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-6 subwrap-tagline">
                    <div class="title-h2 title-h">{!! translation($content['feedback_form']['text'] ?? []) !!}</div>
                </div>

                <div class="col-md-6 subwrap">
                    <div class="title-h2 title-h">{!! translation($content['feedback_form']['form_title'] ?? []) !!}</div>
                    <div class="title-h5 title-h">{!! translation($content['feedback_form']['form_subtitle'] ?? []) !!}</div>

                    <div class="space-half">
                    </div>

                    <form action="{{ route('form.feedback') }}" id="feedbackForm" method="post" name="subscribe">
                        <input class="subscribfield subscribeemail" id="subscribeemail" name="email" type="text" placeholder="{{ translation($content['feedback_form']['email_placeholder'] ?? []) }}">

                        <div class="success" id="mailSendSuccess">
                            {!! translation($content['feedback_form']['success_send_text'] ?? []) !!}
                        </div>

                        <div class="error" id="mailSendFail">
                            {!! translation($content['feedback_form']['fail_send_text'] ?? []) !!}
                        </div>

                        <div class="error" id="formErrors"></div>

                        <button class="btn-form" id="feedbackSubmit" type="submit">
                            {{ translation($content['feedback_form']['button_text'] ?? []) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section aria-label="about" class="about-history" style="padding-top: 40px; padding-bottom: 40px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <article>
                        <div class="title-h2 title-h">{!! translation($content['seo']['title'] ?? []) !!}</div>
                        <span class="devider-cont"></span>

                        {!! translation($content['seo']['text'] ?? []) !!}
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
