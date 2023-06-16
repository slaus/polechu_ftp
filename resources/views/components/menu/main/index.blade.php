@if (! empty($items))
    <nav id="menu-center">
        <ul>
            @include('components.menu.main.items', ['items' => $items])

{{--            @if (! empty(config('localizations.supported_locales')))--}}
{{--                <li>--}}
{{--                    <a  href="#">--}}
{{--                        {{ config('localizations.supported_locales', [])[app()->getLocale()]['native'] ?? app()->getLocale() }}--}}
{{--                        <i class="fa fa-angle-down"></i>--}}
{{--                    </a>--}}
{{--                    <ul>--}}
{{--                        @foreach(config('localizations.supported_locales', []) as $code => $localization)--}}
{{--                            <li style="width: fit-content"><a href="{{ route('locale', $code) }}">{{ $localization['native'] ?? $code }}</a></li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endif--}}

            <li>
                <form role="search" action="{{ route('page', 'blog') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="{{ __('Search') }}">
                        <div class="input-group-btn">
                            <button type="submit"><span class="icon"><i class="fa fa-search"></i></span></button>
                        </div>
                    </div>
                </form>
            </li>
        </ul>
    </nav>
@endif
