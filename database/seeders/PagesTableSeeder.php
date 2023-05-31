<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['slug' => 'home', 'name' => ['en' => 'Home'], 'content' => json_decode('{"banner": {"items": [{"name": {"en": "Five Star Luxury Hotel", "uk": null}, "image": "/media/banners/bg-1.jpg", "stars": "5", "title": {"en": "PROVIDING COMFORTABLE", "uk": null}, "subtitle": {"en": "LUXURY VACATION", "uk": null}, "description": {"en": "LUXURY RESIDENCE", "uk": null}}, {"name": {"en": "Five Star Luxury Hotel", "uk": null}, "image": "/media/banners/bg-4.jpg", "stars": "3", "title": {"en": "PROVIDING COMFORTABLE", "uk": null}, "subtitle": {"en": "LUXURY VACATION", "uk": null}, "description": {"en": "LUXURY BEACH", "uk": null}}, {"name": {"en": "Five Star Luxury Hotel", "uk": null}, "image": "/media/banners/bg-3.jpg", "stars": "4", "title": {"en": "PROVIDING COMFORTABLE", "uk": null}, "subtitle": {"en": "LUXURY VACATION", "uk": null}, "description": {"en": "LUXURY VACATION", "uk": null}}, {"name": {"en": "Five Star Luxury Hotel", "uk": null}, "image": "/media/banners/bg-2.jpg", "stars": "2", "title": {"en": "PROVIDING COMFORTABLE", "uk": null}, "subtitle": {"en": "LUXURY VACATION", "uk": null}, "description": {"en": "LUXURY VACATION", "uk": null}}]}}', true), 'visibility' => true],
            ['slug' => 'about', 'name' => ['en' => 'About'], 'content' => json_decode('{}', true), 'visibility' => true],
            ['slug' => 'blog', 'name' => ['en' => 'Blog'], 'content' => json_decode('{}', true), 'visibility' => true],
            ['slug' => 'contacts', 'name' => ['en' => 'Contacts'], 'content' => json_decode('{}', true), 'visibility' => true],
        ];

        foreach ($data as $item) {
            Page::create($item);
        }
    }
}
