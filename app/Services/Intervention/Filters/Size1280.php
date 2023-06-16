<?php

namespace App\Services\Intervention\Filters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Size1280 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $width = 1280;

        return $image->width() >= $width
            ? $image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            : $image;
    }
}
