@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@push('styles')

@endpush

@push('scripts')

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
            <div id="reservation" class="imgbgres" style="background-image:url(/web/img/bg-res.jpg)">
                <form action="#" id="form1" method="post" name="form1">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <select class="form-control" id="selectroom">
                                <optgroup label="SELECT ROOM">
                                    <option value="LUXURY SINGLE">LUXURY SINGLE ROOM</option>
                                    <option value="LUXURY DOUBLE">LUXURY DOUBLE ROOM</option>
                                    <option value="PREMIUM LUXURY">PREMIUM LUXURY ROOM</option>
                                    <option value="PREMIUM SUITE">PREMIUM SUITE ROOM</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <div class="input-group">
                                <input type="text" name="date1" id="date1" class="form-control fox1" placeholder="CHECK IN DATE">
                                <div class="input-group-btn">
                                    <span class="icon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 form-group">
                            <div class="input-group">
                                <input type="text" name="date2" id="date2" class="form-control fox2" placeholder="CHECK OUT DATE">
                                <div class="input-group-btn">
                                    <span class="icon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 form-group">
                            <input id="personbook" name="personbook" placeholder="PERSON" type="text">
                        </div>

                        <div class="col-sm-4 form-group">
                            <input id="namebook" name="namebook" placeholder="NAME" type="text">
                        </div>

                        <div class="col-sm-3 form-group">
                            <input id="emailbook" name="emailbook" placeholder="EMAIL" type="text">
                        </div>

                        <div class="col-sm-3 form-group">
                            <input id="phonebook" name="phonebook" placeholder="PHONE" type="text">
                        </div>

                        <div class="col-sm-12 form-group">
                            <textarea cols="50" id="messagebook" name="message" placeholder="YOUR MESSAGE" rows="2"></textarea>
                        </div>

                        <div class="success-white" id="mail_success">Thank you. Your reservation has been sent.</div>
                        <div class="error-white" id="mail_failed">Error, email not sent</div>
                        <button class="btn-content" id="send">BOOK NOW</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (! empty(tours()))
        <section class="whitepage">
            <div class="container-fluid">
                <div class="row">
                    @foreach(tours() as $tour)
                        <div class="col-md-4">
                            <div class="wrap-news onStep" data-animation="fadeInLeft" data-time="300">
                                @if (! empty($tour['image']))
                                    <img alt="{{ translation($tour['name'] ?? []) }}" class="img-responsive" src="{{ image_uri($tour['image'], '540') }}">
                                @endif
                                <div class="title-h3 title-h">{{ translation($tour['name'] ?? []) }}</div>
                                <p>{{ translation($tour['description'] ?? []) }}</p>
                                <a class="link-class" href="#">
                                    {{ __('MORE DETAIL') }}
                                    <span class="devider"></span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section aria-label="about" class="about-history" style="padding-top: 0">
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

    @if (! empty(posts((int) ($content['posts']['count'] ?? 10))))
        <section class="whitepage" style="padding-top: 0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <div class="title-h2 title-h">{{ translation($content['posts']['title'] ?? []) }}</div>
                            <span class="devider-center"></span>
                            <div class="title-h3 title-h">{{ translation($content['posts']['subtitle'] ?? []) }}</div>
                        </div>
                    </div>
                    <div class="space-double"></div>
                    <div class="onStep" data-animation="fadeInUp" data-time="300">
                        <div class="owl-carousel" id="owl-post">
                            @foreach(posts((int) ($content['posts']['count'] ?? 10)) as $post)
                                <div class="item">
                                    <div class="recent-post" style="background-image:url('{{ image_uri($post['image'] ?? '') }}')">
                                        <div class="hovereffect">
                                            <a href="{{ route('post', $post['slug']) }}">
                                                <div class="overlay ">
                                                    <div class="content">
                                                        <div class="heading">
                                                            {{ translation($post['name'] ?? []) }}
                                                            <span class="devider-recent"></span>
                                                        </div>
                                                        <div class="subheading">{{ $post['published_at'] }}</div>
                                                        <div class="readmore">{{ __('Read more') }} <i class="fa fa-angle-right"></i></div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
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
@endsection
