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
                    <h1>{{ translation($post['name'] ?? []) }}</h1>
                </div>
            </div>
        </div>
    </section>
@endsection
