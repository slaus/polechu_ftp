@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@push('styles')

@endpush

@push('scripts')

@endpush

@section('content')
    <section id="subheader" @if(! empty($content['banner']['image'])) style="background: url('{{ $content['banner']['image'] }}')" @endif>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-h1 title-h">{{ translation($content['banner']['title'] ?? $page['name'] ?? []) }}</div>
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
                            <a href="{{ route('page') }}">Home</a>
                        </li>

                        <li class="sep">/
                        </li>

                        <li>{{ translation($page['name'] ?? []) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

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
@endsection
