<div class="widget">
    <form role="search" action="{{ route('page', 'blog') }}" method="get">
        <div class="input-group">
            <input type="text" id="search1" name="search" class="form-control" value="{{ request('search') }}" placeholder="{{ __('SEARCH') }}">
            <div class="input-group-btn">
                <button type="submit"><span class="icon"><i class="fa fa-search"></i></span></button>
            </div>
        </div>
    </form>
</div>
