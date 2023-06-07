<?php

namespace App\Services\Intervention\Filters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Size1920 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $width = 1920;

        return $image->width() >= $width
            ? $image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            : $image;
    }
}
