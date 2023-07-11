@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])

    <link rel="canonical" href="{{ route('page', 'blog') }}" />
@endpush

@push('styles')

@endpush

@push('scripts')

@endpush

@section('content')
    <section id="subheader" @if(! empty($content['banner']['image'])) style="background: url('{{ image_uri($content['banner']['image']) }}') top fixed" @endif>
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

    <section aria-label="section-blog" id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="onStep" data-animation="fadeInUp" data-time="300">
                        @foreach($posts['data'] ?? [] as $post)
                            <article>
                                <div class="post-image">
                                    @if (! empty($post['image']))
                                        <img alt="blog-img" class="img-responsive" src="{{ image_uri($post['image'], '768') }}">
                                    @endif
                                    <div class="post-heading">
                                        <div class="post-title-h3 title-h">
                                            <a href="{{ route('post', $post['slug']) }}">{{ translation($post['name'] ?? []) }}</a>
                                        </div>
                                    </div>
                                </div>

                                <p>{{ translation($post['description'] ?? []) }}</p>

                                <div class="bottom-article">
                                    <div>{{ $post['format_published_at'] }}</div>
                                </div>
                            </article>
                        @endforeach

                        @if ($posts['meta']['last_page'] > 1)
                            <div id="pagination">
                                <span class="pagina-num">{{ __('Page :current_page of :last_page', ['current_page' => $posts['meta']['current_page'], 'last_page' => $posts['meta']['last_page']]) }}</span>

                                @for($i = 1; $i <= $posts['meta']['last_page']; $i++)
                                    <a class="@if ($posts['meta']['current_page'] == $i) current @else inactive @endif" href="{{ $posts['meta']['path'] . '?page=' . $i }}">{{ $i }}</a>
                                @endfor

                                <span class="pull-right">
                                    @if ($posts['meta']['current_page'] > 1)
                                        <a href="{{ $posts['meta']['path'] . '?page=' . ($posts['meta']['current_page'] - 1) }}">{{ __('prev') }}</a>
                                    @else
                                        <span>{{ __('prev') }}</span>
                                    @endif

                                    @if ($posts['meta']['last_page'] > $posts['meta']['current_page'])
                                        <a href="{{ $posts['meta']['next_page_url'] }}">{{ __('next') }}</a>
                                    @else
                                        <span>{{ __('next') }}</span>
                                    @endif
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <aside class="onStep" data-animation="fadeInUp" data-time="600">
                        @if (! empty(posts(3, array_column($posts['data'], 'id'))))
                            @include('web.widgets.recent-posts', ['posts' => posts(3, array_column($posts['data'], 'id'))])
                        @endif

{{--                        @if (! empty(tags('post')))--}}
{{--                            @include('web.widgets.tags-cloud', ['tags' => tags('post')])--}}
{{--                        @endif--}}

                        @if (! empty(translation($content['seo']['title'] ?? [])) || ! empty(translation($content['seo']['text'] ?? [])))
                            @include('web.widgets.seo-text', ['title' => translation($content['seo']['title'] ?? []), 'text' => translation($content['seo']['text'] ?? [])])
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
