<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\PostViewModel;
use App\Models\Page;
use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __invoke(string $slug): View
    {
        $post = Post::with(['tags'])->where('slug', $slug)->where('visibility', true)->firstOrFail();
        $page = Page::where('slug', 'blog')->where('visibility', true)->firstOrFail();

        $post->page = $page;

        $data = new PostViewModel($post);

        return view('web.posts.single', $data);
    }
}
