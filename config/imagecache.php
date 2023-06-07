<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    |
    | {route}/{template}/{filename}
    |
    | Examples: "images", "img/cache"
    |
    */

    'route' => 'images',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submitted
    | by URI.
    |
    | Define as many directories as you like.
    |
    */

    'paths' => [
        public_path(),
        public_path('upload'),
        public_path('images'),
        storage_path('app/media'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */

    'templates' => [
        'thumbnail' => App\Services\Intervention\Filters\Thumbnail::class,
        'thumb' => App\Services\Intervention\Filters\Thumbnail::class,

        '320' => App\Services\Intervention\Filters\Size320::class,
        '540' => App\Services\Intervention\Filters\Size540::class,
        '768' => App\Services\Intervention\Filters\Size768::class,
        '1280' => App\Services\Intervention\Filters\Size1280::class,
        '1920' => App\Services\Intervention\Filters\Size1920::class,

        'webp-540' => App\Services\Intervention\Filters\SizeWebp540::class,
        'webp-768' => App\Services\Intervention\Filters\SizeWebp768::class,
        'webp-1280' => App\Services\Intervention\Filters\SizeWebp1280::class,
        'webp-1920' => App\Services\Intervention\Filters\SizeWebp1920::class,

        'small' => Intervention\Image\Templates\Small::class,
        'medium' => Intervention\Image\Templates\Medium::class,
        'large' => Intervention\Image\Templates\Large::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */

    'lifetime' => 43200,

];
