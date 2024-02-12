@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@section('content')
    <section aria-label="about" class="about-history" style="padding-top: 40px; padding-bottom: 40px">
        <div class="container" style="margin-top: 40px; margin-bottom: 40px;">
            {!! translation($content['seo']['text']) !!}
        </div>
    </section>
@endsection
