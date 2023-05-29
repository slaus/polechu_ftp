<title>{{ translation($seo['title'] ?? []) }}</title>

@if (! empty(translation($seo['description'] ?? [])))
<meta name="description" content="{{ translation($seo['description'] ?? []) }}" />
@endif
@if (! empty($seo['indexes']) && $seo['indexes'] != 'all')
<meta name="robots" content="{{ $seo['indexes'] }}" />
@endif
