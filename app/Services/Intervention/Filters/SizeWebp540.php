<?php

namespace App\Services\Intervention\Filters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class SizeWebp540 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(540, null)->encode('webp');
    }
}
