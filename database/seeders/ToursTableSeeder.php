<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Seeder;

class ToursTableSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'slug' => 'luxury-single-room',
                'name' => json_decode('{"en": null, "uk": "LUXURY SINGLE ROOM"}', true),
                'image' => '/media/tours/img-news.jpg',
                'gallery' => [],
                'description' => json_decode('{"en": null, "uk": "Qui ut ceteros comprehensam. Cu eos sale sanctus eligendi, id ius elitr saperet, ocurreret pertinacia pri an. No mei nibh consectetuer, semper laoreet perfecto ad qui, est rebum nulla argumentum ei."}', true),
                'content' => json_decode('{}', true),
                'visibility' => true,
                'order' => 0,
            ],
            [
                'slug' => 'luxury-double-room',
                'name' => json_decode('{"en": null, "uk": "LUXURY DOUBLE ROOM"}', true),
                'image' => '/media/tours/img-news1.jpg',
                'gallery' => [],
                'description' => json_decode('{"en": null, "uk": "Qui ut ceteros comprehensam. Cu eos sale sanctus eligendi, id ius elitr saperet, ocurreret pertinacia pri an. No mei nibh consectetuer, semper laoreet perfecto ad qui, est rebum nulla argumentum ei."}', true),
                'content' => json_decode('{}', true),
                'visibility' => true,
                'order' => 1,
            ],
            [
                'slug' => 'luxury-premium-room',
                'name' => json_decode('{"en": null, "uk": "LUXURY PREMIUM ROOM"}', true),
                'image' => '/media/tours/img-news2.jpg',
                'gallery' => [],
                'description' => json_decode('{"en": null, "uk": "Qui ut ceteros comprehensam. Cu eos sale sanctus eligendi, id ius elitr saperet, ocurreret pertinacia pri an. No mei nibh consectetuer, semper laoreet perfecto ad qui, est rebum nulla argumentum ei."}', true),
                'content' => json_decode('{}', true),
                'visibility' => true,
                'order' => 2,
            ],
        ];

        foreach ($data as $item) {
            Tour::create($item);
        }
    }
}
