<?php

namespace App\Services\Intervention\Filters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class SizeWebp1920 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(1920, null)->encode('webp');
    }
}
