<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MediaFilesSeeder extends Seeder
{
    public function run(): void
    {
        File::copyDirectory(base_path('resources/seed/media'), config('filesystems.disks.media.root'));
    }
}
