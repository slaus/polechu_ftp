<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\PageViewModel;
use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __invoke(string $slug = ''): View
    {
        $slug = ! empty($slug) ? $slug : 'home';

        $page = Page::where('slug', $slug)->where('visibility', true)->firstOrFail();

        $data = new PageViewModel($page);

        return view()->exists('web.pages.' . $slug)
            ? view('web.pages.' . $slug, $data)
            : view('web.pages.default', $data);
    }
}
