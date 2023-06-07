<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\PageViewModel;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __invoke(Request $request, string $slug = ''): View
    {
        $slug = ! empty($slug) ? $slug : 'home';

        $page = Page::where('slug', $slug)->where('visibility', true)->firstOrFail();

        if ($slug == 'blog') {
            $query = Post::where('visibility', true);

            if (! empty($request->get('search'))) {
                $search = $request->get('search');
                $query->where('name->' . app()->getLocale(), 'like', '%' . $search . '%')
                    ->orWhere('description->' . app()->getLocale(), 'like', '%' . $search . '%')
                    ->orWhere('content->' . app()->getLocale(), 'like', '%' . $search . '%');
            }

            if (! empty($request->get('tag'))) {
                $tag = $request->get('tag');
                $query->whereHas('tags', function (Builder $builder) use ($tag) {
                    $builder->where('slug->' . Tag::getLocale(), $tag);
                });
            }

            $page->posts = $query->paginate(3);
        }

        $data = new PageViewModel($page);

        return view()->exists('web.pages.' . $slug)
            ? view('web.pages.' . $slug, $data)
            : view('web.pages.default', $data);
    }
}
