@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@push('styles')

@endpush

@push('scripts')

@endpush

@section('content')
    <section id="subheader" @if(! empty($content['banner']['image'])) style="background: url('{{ image_uri($content['banner']['image']) }}') top fixed;background-size: cover;" @endif>
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

                <div class="col-md-12 center">
                    <ul class="subdetail">
                        <li>
                            <a href="{{ route('page') }}">{{ __('Home') }}</a>
                        </li>

                        <li class="sep">/</li>

                        <li>{{ translation($page['name'] ?? []) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @if (! empty(employees()))
        <section class="whitepage">
            <div class="container">
                <div class="row">
                    @if (! empty($content['employees']['title']) || ! empty($content['employees']['subtitle']))
                        <div class="col-md-12">
                            <div class="text-center">
                                @if (! empty($content['employees']['title']))
                                    <h2 class="title-h2 title-h">{{ translation($content['employees']['title']) }}</h2>
                                    <span class="devider-center"></span>
                                @endif

                                @if (! empty($content['employees']['subtitle']))
                                    <div class="title-h3 title-h">{{ translation($content['employees']['subtitle']) }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="space-double" style="height: 40px;"></div>
                    @endif

                    <div class="onStep" data-animation="fadeInUp" data-time="300">
                        <div class="owl-carousel" id="owl-team">
                            @foreach(employees() as $employee)
                                <div class="item">
                                    <div class="team" style="background-image:url('{{ $employee['image'] }}')">
                                        <div class="hovereffect">
                                            <div>
                                                <div class="overlay ">
                                                    <div class="content">
                                                        <div class="heading" style="padding: 0 0 15px 0;">
                                                            {{ translation($employee['name'] ?? []) }}
                                                            <span class="devider-recent"></span>
                                                        </div>

                                                        @if (! empty($employee['position']))
                                                            <div class="subheading" style="padding: 0 0 15px 0;">{{ translation($employee['position']) }}</div>
                                                        @endif

                                                        @if (! empty($employee['description']))
                                                            <div class="description" style="white-space: initial; padding: 0 0 15px 0;">
                                                                {!! translation($employee['description']) !!}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
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

    @if (! empty($content['seo']['title']) || ! empty($content['seo']['text']))
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
    @endif
@endsection
