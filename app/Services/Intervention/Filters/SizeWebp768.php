<?php

namespace App\Services\Intervention\Filters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class SizeWebp768 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(768, null)->encode('webp');
    }
}
