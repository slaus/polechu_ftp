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

            @if(filter_var($searchButton, FILTER_VALIDATE_BOOLEAN))
                <li>
                    <div class="input-group">
                        <button id="searchTourButton" class="btn-form" style="background: #ffb600; height: 40px; padding: 0 20px; margin: 0;width: 100%">
                            {{ __('Search tour') }}
                        </button>
                    </div>
                </li>
            @endif
        </ul>
    </nav>
@endif
