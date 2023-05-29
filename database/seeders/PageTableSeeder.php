<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['slug' => 'home', 'name' => ['en' => 'Home'], 'content' => json_decode('{}', true), 'visibility' => true],
            ['slug' => 'about', 'name' => ['en' => 'About'], 'content' => json_decode('{}', true), 'visibility' => true],
            ['slug' => 'blog', 'name' => ['en' => 'Blog'], 'content' => json_decode('{}', true), 'visibility' => true],
            ['slug' => 'contacts', 'name' => ['en' => 'Contacts'], 'content' => json_decode('{}', true), 'visibility' => true],
        ];

        foreach ($data as $item) {
            Page::create($item);
        }
    }
}
