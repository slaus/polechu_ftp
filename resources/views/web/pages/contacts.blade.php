@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@push('styles')

@endpush

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?v=3&key={{ settings('api.google_map.api_key') }}"></script>
    <script src="{{ asset('web/js/map.js') }}" type="text/javascript"></script>
@endpush

@section('content')
    <section id="subheader" @if(! empty($content['banner']['image'])) style="background: url('{{ image_uri($content['banner']['image']) }}');background-size: cover;" @endif>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-h1 title-h">{{ translation($content['banner']['title'] ?? $page['name'] ?? []) }}</h1>
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

                        <li class="sep">/
                        </li>

                        <li>{{ translation($page['name'] ?? []) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section aria-label="contact" class="whitepage">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="onStep" data-animation="fadeInLeft" data-time="300" id="map"></div>
                </div>

                <div class="space-double"></div>

                <div class="col-md-8 col-xs-12">
                    <div class="title-h2 title-h">{{ translation($content['contact_form']['title'] ?? []) }}</div>

                    <div class="space-single"></div>

                    <div class="onStep" data-animation="fadeInUp" data-time="300" id="contact">
                        <form action="{{ route('form.contact') }}" class="row" id="contactForm" method="post" name="form-contact">
                            <input id="name-contact" name="name" placeholder="{{ translation($content['contact_form']['name_placeholder'] ?? []) }}" type="text">
                            <input id="email-contact" name="email" placeholder="{{ translation($content['contact_form']['email_placeholder'] ?? []) }}" type="text">

                            <textarea cols="50" id="message-contact" name="message" placeholder="{{ translation($content['contact_form']['text_placeholder'] ?? []) }}" rows="4"></textarea>
                            <div class="success" id="mailSendSuccess">
                                {{ translation($content['contact_form']['success_send_text'] ?? []) }}
                            </div>

                            <div class="error" id="mailSendFail">
                                {{ translation($content['contact_form']['fail_send_text'] ?? []) }}
                            </div>

                            <div class="error" id="formErrors"></div>

                            <button class="btn-contact" id="contactSubmit" type="submit">{{ translation($content['contact_form']['button_text'] ?? []) }}</button>
                        </form>
                    </div>
                    <div class="space-single"></div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="title-h2 title-h">{{ translation($content['address']['title'] ?? []) }}</div>

                    <div class="space-single"></div>

                    <div class="wrapaddres onStep" data-animation="fadeInUp" data-time="600">
                        <address>
                            {!! translation($content['address']['text'] ?? []) !!}
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
