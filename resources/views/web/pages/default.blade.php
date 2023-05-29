@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@push('styles')

@endpush

@push('scripts')

@endpush

@section('content')
    <section id="subheader">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ translation($page['name'] ?? []) }}</h1>
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
@endsection
