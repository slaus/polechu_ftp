<div class="widget">
    <div class="title-h5 title-h" style="margin-top: 0">
        {{ __('Recent posts') }}
    </div>

    <div class="devider-widget">
    </div>

    <div class="recent">
        @foreach($posts as $post)
            <div>
                @if (! empty($post['image']))
                    <img alt="blog-img" class="pull-left" src="{{ image_uri($post['image'], 'thumb') }}">
                @endif

                <div class="title-h6 title-h">
                    <a href="{{ route('post', $post['slug']) }}">{{ translation($post['name'] ?? []) }}</a>
                </div>

                <p>{{ mb_strimwidth(translation($post['description'] ?? []), 0, 70, '...') }}</p>
            </div>
        @endforeach
    </div>
</div>
