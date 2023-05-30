<title>{{ translation($seo['title'] ?? []) }}</title>

@if (! empty(translation($seo['description'] ?? [])))
    <meta name="description" content="{{ translation($seo['description'] ?? []) }}" />
@endif
@if (! empty($seo['indexes']) && $seo['indexes'] != 'all')
    <meta name="robots" content="{{ $seo['indexes'] }}" />
@endif

<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:locale" content="{{ config('localizations.supported_locales.' . app()->getLocale() . '.regional', app()->getLocale()) }}" />
<meta property="og:url" content="{{ url()->current() }}" />
@if (! empty($seo['og']['type']))
    <meta property="og:type" content="{{ $seo['og']['type'] }}" />
@endif
@if (! empty(translation($seo['og']['title'] ?? [])))
    <meta property="og:title" content="{{ translation($seo['og']['title'] ?? []) }}" />
@endif
@if (! empty(translation($seo['og']['description'] ?? [])))
    <meta property="og:description" content="{{ translation($seo['og']['description'] ?? []) }}" />
@endif
@if (! empty($seo['og']['image']))
    <meta property="og:image" content="{{ image_uri($seo['og']['image']) }}" />
@endif
@foreach(collect(config('localizations.supported_locales'))->except(app()->getLocale())->pluck('regional')->toArray() as $locale)
    <meta property="og:locale:alternate" content="{{ $locale }}">
@endforeach
