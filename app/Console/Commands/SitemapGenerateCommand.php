<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Post;
use App\Models\Tour;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapGenerateCommand extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Sitemap generate';

    public function handle(): void
    {
        $sitemap = Sitemap::create();

        Page::where('visibility', true)->each(function (Page $page) use ($sitemap) {
            $url = Url::create(route('page', $page->slug != 'home' ? $page->slug : ''))
                ->setPriority($page->slug == 'home' ? 1 : 0.7)
                ->setLastModificationDate(now());

            $sitemap->add($url);
        });

        Tour::where('visibility', true)->each(function (Tour $tour) use ($sitemap) {
            $url = Url::create(route('tours', $tour->slug))
                ->setPriority(0.8)
                ->setLastModificationDate(now());

            $sitemap->add($url);
        });

        Post::where('visibility', true)->each(function (Post $post) use ($sitemap) {
            $url = Url::create(route('post', $post->slug))
                ->setPriority(0.8)
                ->setLastModificationDate(now());

            $sitemap->add($url);
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
