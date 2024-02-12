@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@push('styles')
<style>
    .flex-between-wrap {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
</style>
@endpush

@section('content')
    <section style="margin-top: 40px; margin-bottom: 40px">
        <div class="container">
            {!! translation($content['seo']['text']) !!}
        </div>
    </section>

    <section>
        <div class="container">
            <div class="flex-between-wrap">
                <img src="/images/icons/countries/cxr.svg" height="40" />
                <img src="/images/icons/countries/per.svg" height="40" />
                <img src="/images/icons/countries/bol.svg" height="40" />
                <img src="/images/icons/countries/blm.svg" height="40" />
                <img src="/images/icons/countries/jpn.svg" height="40" />
                <img src="/images/icons/countries/zaf.svg" height="40" />
                <img src="/images/icons/countries/kna.svg" height="40" />
            </div>
        </div>
    </section>
@endsection
