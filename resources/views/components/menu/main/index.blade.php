@if (! empty($items))
    <nav id="menu-center">
        <ul>
            @include('components.menu.main.items', ['items' => $items])

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
