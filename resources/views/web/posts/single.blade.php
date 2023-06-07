@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
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
                    <div class="title-h1 title-h">{{ translation($post['name'] ?? []) }}</div>
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

                                <div class="post-heading">
                                    <div class="title-h3 title-h">
                                        <a href="{{ route('post', $post['slug']) }}">{{ translation($post['name'] ?? []) }}</a>
                                </div>
                            </div>

                            {!! translation($post['content'] ?? []) !!}

                            <div class="bottom-article">
                                <ul class="meta-post">
                                    <li>
                                        <a class="link" href="{{ route('post', $post['slug']) }}">{{ $post['format_published_at'] }}</a>
                                    </li>
                                </ul>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="col-md-4">
                    <aside class="onStep" data-animation="fadeInUp" data-time="600">
                        @include('web.widgets.posts-search')

                        @if (! empty(posts(3, [$post['id']])))
                            @include('web.widgets.recent-posts', ['posts' => posts(3, [$post['id']])])
                        @endif

                        @if (! empty(tags('post')))
                            @include('web.widgets.tags-cloud', ['tags' => tags('post')])
                        @endif

                        @if (! empty(translation($post['page']['content']['seo']['title'] ?? [])) || ! empty(translation($post['page']['content']['seo']['text'] ?? [])))
                            @include('web.widgets.seo-text', ['title' => translation($post['page']['content']['seo']['title'] ?? []), 'text' => translation($post['page']['content']['seo']['text'] ?? [])])
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
