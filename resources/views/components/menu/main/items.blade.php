@foreach($items as $item)
    <li>
        <a
            href="{{ $item['properties']['url'] ?? '#' }}"
            @if(($item['properties']['url'] ?? '#') == url()->current()) class="actived" @endif
            @if (! empty($item['properties']['target'])) target="{{ $item['properties']['target'] }}" rel="nofollow" @endif
        >
            {{ translation($item['name'] ?? []) }} @if (! empty($item['children'])) <i class="fa fa-angle-down"></i> @endif
        </a>

        @if (! empty($item['children']))
            <ul>
                @include('components.menu.main.items', ['items' => $item['children']])
            </ul>
        @endif
    </li>
@endforeach
