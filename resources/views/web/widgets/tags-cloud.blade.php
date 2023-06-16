<div class="widget">
    <div class="title-h5 title-h">
        {{ __('Tags') }}
    </div>

    <div class="devider-widget">
    </div>

    <div class="tags">
        @foreach($tags as $tag)
            <div>
                <a href="{{ route('page', ['slug' => 'blog', 'tag' => $tag['slug'][\App\Models\Tag::getLocale()] ?? '']) }}">{{ $tag['name'][\App\Models\Tag::getLocale()] ?? '' }}</a>
            </div>
        @endforeach
    </div>
</div>
