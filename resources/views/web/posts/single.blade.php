@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])

    <meta property="og:title" content="{{ translation($post['name'] ?? []) }}">
    <meta property="og:description" content="{{ translation($post['description'] ?? []) }}">
    @if(! empty($post['page']['content']['banner']['image']))
    <meta property="og:image" content="{{ image_uri($post['page']['content']['banner']['image']) }}">
    @endif
    <meta property="og:url" content="{{ route('post', $post['slug']) }}">
    <meta property="og:site_name" content="{{ translation(settings('company.name', ['uk' => config('app.name', '')])) }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ua_UA">
    @if (! empty($post['author']))
    <meta property="og:article:author" content="{{ translation($post['author']) }}">
    @endif
    <meta property="og:article:published_time" content="{{ $post['format_published_at'] }}">
@endpush

@push('styles')

@endpush

@push('scripts')

@endpush

@section('content')
    <section id="subheader" @if(! empty($post['page']['content']['banner']['image'])) style="background: url('{{ image_uri($post['page']['content']['banner']['image']) }}') top fixed" @endif>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-h1 title-h">{{ translation($post['name'] ?? []) }}</h1>
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

                        <li>
                            <a href="{{ route('page', 'blog') }}">{{ __('Blog') }}</a>
                        </li>

                        <li class="sep">/</li>

                        <li>{{ translation($post['name'] ?? []) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section aria-label="section-blogg" id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="onStep" data-animation="fadeInUp" data-time="300">
                        <article>
                            <div class="post-image">
                                @if (! empty($post['image']))
                                    <img alt="blog-img" class="img-responsive" src="{{ image_uri($post['image'], '768') }}">
                                @endif
                            </div>

                            {!! translation($post['content'] ?? []) !!}

                            <div class="bottom-article">
                                <div style="display:flex;justify-content:space-between;align-items:center;">
                                    <div>
                                        <span>
                                            {{ $post['format_published_at'] }}.
                                        </span>

                                        @if (! empty($post['author']))
                                            <span style="margin-left: 8px">{{ translation($post['author']) }}</span>
                                        @endif
                                    </div>

                                    <div class="widget" style="margin: 20px 0;">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('post', $post['slug'])) }}&amp;{{ urlencode('p[images][0]') }}={{ ! empty($post['image']) ? urlencode(image_uri($post['image'], '768')) : '' }}" title="{{ urlencode(translation($post['name'] ?? [])) }}" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" rel="nofollow" target="_parent">
                                            <img src="/images/icons/facebook.svg" width="40" height="40" alt="Facebook">
                                        </a>

                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('post', $post['slug'])) }}&amp;text={{ urlencode(translation($post['name'] ?? [])) }}" title="{{ translation($post['name'] ?? []) }}" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" rel="nofollow" target="_parent">
                                            <img src="/images/icons/twitter.svg" width="40" height="40" alt="Twitter">
                                        </a>

                                        <a href="https://telegram.me/share/url?url={{ urlencode(route('post', $post['slug'])) }}&amp;text={{ urlencode(translation($post['name'] ?? [])) }}" rel="nofollow" target="_blank">
                                            <img src="/images/icons/telegramm.svg" width="40" height="40" alt="Telegram">
                                        </a>

                                        <a href="viber://forward?text={{ urlencode(route('post', $post['slug'])) }}" rel="nofollow" target="_blank">
                                            <img src="/images/icons/viber.svg" width="40" height="40" alt="Viber">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="col-md-4">
                    <aside class="onStep" data-animation="fadeInUp" data-time="600">
                        @if (! empty(posts(3, [$post['id']])))
                            @include('web.widgets.recent-posts', ['posts' => posts(3, [$post['id']])])
                        @endif

{{--                        @if (! empty(tags('post')))--}}
{{--                            @include('web.widgets.tags-cloud', ['tags' => tags('post')])--}}
{{--                        @endif--}}
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
